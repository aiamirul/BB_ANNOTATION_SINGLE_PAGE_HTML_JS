
<?php
$imagepath = isset($_GET['imagepath']) ? $_GET['imagepath'] : 'imagepath';

?>
<!DOCTYPE html>
<script>
    let imgpath = "<?php echo htmlspecialchars($imagepath, ENT_QUOTES, 'UTF-8'); ?>.jpg";
    let xmlpath = "<?php echo htmlspecialchars($imagepath, ENT_QUOTES, 'UTF-8'); ?>.xml";
    console.log(imgpath ); // Output: John (if ?name=John)
    console.log(xmlpath );  // Output: 25 (if ?age=25)
</script>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Annotation</title>
    <style>
        #canvas-container { position: relative; display: inline-block; }
        #annotationCanvas { position: absolute; top: 0; left: 0; }
        table { margin-top: 10px; border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid black; padding: 1px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<input type="range" id="scaleSlider" min="0.5" max="3" step="0.1" value="1">

 <button onclick="savePascalVOC()">Save XML</button>


<table><tr><td>
    <input hidden type="file" id="imageUpload" accept="image/*">
    <div id="canvas-container">
        <img id="image" crossorigin="anonymous" style="transform: scale(1); transform-origin: top left;">
        <canvas id="annotationCanvas" style="transform: scale(1); transform-origin: top left;"></canvas>
    </div>
    <br>
	<!-- </td><td><button onclick="downloadPascalVOC()">Download XML</button>
 <button onclick="downloadYOLO()">Download YOLO TXT</button> -->
 <!-- <input type="file" id="xmlUpload" accept=".xml"> -->


    <script>
        image = document.getElementById("image");
        canvas = document.getElementById("annotationCanvas");
        slider = document.getElementById("scaleSlider");

        function updateScale() {
            const scale = slider.value;
            image.style.transform = `scale(${scale})`;
            canvas.style.transform = `scale(${scale})`;
        }

        slider.addEventListener("input", updateScale);
    </script>
</td>

    <script>
        function downloadYOLO() {
            let table = document.getElementById("boundingBoxTable");
            let rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
			let canvas = document.getElementById("annotationCanvas");
			let imgWidth = canvas.width;   // Get image width from canvas
			let imgHeight = canvas.height; // Get image height from canvas


            let labelMap = { "b": 0, "br": 1, "bl": 2 ,"f": 3,"fr": 4,"fl": 5,"r": 6,"l": 7,}; // Assign unique class IDs

            let yoloData = "";

            for (let row of rows) {
                let cells = row.getElementsByTagName("td");
                let label = cells[0].innerText;
                let xmin = parseInt(cells[1].innerText);
                let ymin = parseInt(cells[2].innerText);
                let xmax = parseInt(cells[3].innerText);
                let ymax = parseInt(cells[4].innerText);

                let class_id = labelMap[label] ?? 0; // Default to 0 if not in labelMap
                
                // Normalize values for YOLO format
                let x_center = ((xmin + xmax) / 2) / imgWidth;
                let y_center = ((ymin + ymax) / 2) / imgHeight;
                let width = (xmax - xmin) / imgWidth;
                let height = (ymax - ymin) / imgHeight;

                yoloData += `${class_id} ${x_center.toFixed(6)} ${y_center.toFixed(6)} ${width.toFixed(6)} ${height.toFixed(6)}\n`;
            }

            let blob = new Blob([yoloData], { type: "text/plain" });
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "labels.txt";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
	
	
    <table id="boundingBoxTable">
        <thead>
            <tr>
                <th>Label</th>
                <th>Xmin</th>
                <th>Ymin</th>
                <th>Xmax</th>
                <th>Ymax</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

	</td>
	</tr>
    <br>
       <script>
        let canvas = document.getElementById("annotationCanvas");
        let ctx = canvas.getContext("2d");
        let img = document.getElementById("image");
        let boxes = [];
        let drawing = false;
        let startX, startY, currentX, currentY;

        const arrowColors = {
            'l': '#FF0000', 'r': '#00FF00', 'f': '#0000FF', 'b': '#FFFF00',
            'fr': '#FF00FF', 'fl': '#00FFFF', 'bl': '#FFA500', 'br': '#800080'
        };

        document.getElementById("imageUpload").addEventListener("change", function(event) {
            let file = event.target.files[0];
            let reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                img.onload = () => {
                    canvas.width = img.width;
                    canvas.height = img.height;
                };
            };
            reader.readAsDataURL(file);
        });
        

        function loadImage(src) {
            let img = document.getElementById("image");
            img.crossOrigin = "anonymous";
            img.src = src;
            img.onload = () => {
                let canvas = document.getElementById("annotationCanvas");
                let ctx = canvas.getContext("2d");
                
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
            };
        }






        canvas.addEventListener("mousedown", (e) => {
            drawing = true;
            startX = e.offsetX;
            startY = e.offsetY;
        });

        canvas.addEventListener("mousemove", (e) => {
            if (!drawing) return;
            currentX = e.offsetX;
            currentY = e.offsetY;
            redrawCanvas();
            ctx.strokeStyle = "blue";
            ctx.lineWidth = 1;
            ctx.strokeRect(startX, startY, currentX - startX, currentY - startY);
        });canvas.addEventListener("mouseup", (e) => {
    if (!drawing) return;
    drawing = false;
    let endX = e.offsetX;
    let endY = e.offsetY;

    // Ensure top-left to bottom-right order
    let normStartX = Math.min(startX, endX);
    let normStartY = Math.min(startY, endY);
    let normEndX = Math.max(startX, endX);
    let normEndY = Math.max(startY, endY);
	
	

	console.log("BB:",startX, startY, endY, endX );
    console.log("Normalization:",normStartX, normStartY, normEndX, normEndY );
    let inputField = document.createElement("input");
    inputField.type = "text";
    inputField.placeholder = "Enter label name";
    document.body.appendChild(inputField);
    inputField.focus();
    

    //SPEED INPUT DETECT SHO
    inputField.addEventListener("input", () => {
        let name = inputField.value.toLowerCase().trim();
        if (["bb", "ll", "rr", "ff","fr","fl","br","bl"].includes(name)) {
		  console.log(name);
		if (["ff", "ll", "rr", "bb"].includes(name)) {
            name = name[0]; // Convert to single letter
			console.log("converted",name);
        }
            //alert(`Auto-entered: ${name}`);
			console.log("inputfieldChecker:",normStartX, normStartY, normEndX, normEndY )
            addBox(name,normStartX, normStartY, normEndX, normEndY);
			inputField.remove();
        }
		
    });
	
	
	 function addBox(name,startX, startY, endX, endY) {
	 
		
        if (!name) return;
        if (arrowColors.hasOwnProperty(name)) {
            name = name;
        }
        let box = { startX, startY, endX, endY, name };
		console.log("box:",box )
        boxes.push(box);
        redrawCanvas();
        updateTable();
    }
	
	
   
	
});



        function redrawCanvas(highlightBox = null) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.globalAlpha = highlightBox ? 0.3 : 1;
            ctx.drawImage(img, 0, 0);
            ctx.globalAlpha = 1;
            boxes.forEach(box => {

             

                let color = arrowColors[box.name]
                ctx.strokeStyle = box === highlightBox ? "yellow" : color;
                ctx.lineWidth = box === highlightBox ? 1 : 0.5;
                ctx.strokeRect(box.startX, box.startY, box.endX - box.startX, box.endY - box.startY);
                ctx.fillStyle = "white";
                ctx.fillRect(box.startX, box.startY - 20, ctx.measureText(box.name).width + 10, 20);
                ctx.fillStyle = "black";
                ctx.fillText(box.name, box.startX + 5, box.startY - 5);
                drawArrow(box);
            });
        }
 function drawArrow(box) {
            let arrowDir = box.name.toLowerCase();
            let color = arrowColors[arrowDir] || "black";
            let centerX = (box.startX + box.endX) / 2;
            let topY = box.startY;
            let arrowY =topY - ((box.endY - box.startY) * 0.2)-20;
            let arrowEndX = centerX;
            let arrowEndY = arrowY;

            switch (arrowDir) {
                case 'l': arrowEndX -= 20; break;
                case 'r': arrowEndX += 20; break;
                case 'f': arrowEndY += 20; break;
                case 'b': arrowEndY -= 20; break;
                case 'fr': arrowEndX += 15; arrowEndY += 15; break;
                case 'fl': arrowEndX -= 15; arrowEndY += 15; break;
                case 'bl': arrowEndX -= 15; arrowEndY -= 15; break;
                case 'br': arrowEndX += 15; arrowEndY -= 15; break;
            }

            ctx.beginPath();
            ctx.moveTo(centerX, arrowY);
            ctx.lineTo(arrowEndX, arrowEndY);
            ctx.strokeStyle = color;
            ctx.lineWidth = 3;
            ctx.stroke();
            
            // Draw arrowhead
            let angle = Math.atan2(arrowEndY - arrowY, arrowEndX - centerX);
            let headLength = 10;
            ctx.beginPath();
            ctx.moveTo(arrowEndX, arrowEndY);
            ctx.lineTo(arrowEndX - headLength * Math.cos(angle - Math.PI / 6), 
                       arrowEndY - headLength * Math.sin(angle - Math.PI / 6));
            ctx.moveTo(arrowEndX, arrowEndY);
            ctx.lineTo(arrowEndX - headLength * Math.cos(angle + Math.PI / 6), 
                       arrowEndY - headLength * Math.sin(angle + Math.PI / 6));
            ctx.stroke();
        }

        function updateTable() {
            let tbody = document.querySelector("#boundingBoxTable tbody");
            tbody.innerHTML = "";
            boxes.forEach((box, index) => {
                let row = tbody.insertRow();
                row.innerHTML = `
                    <td>${box.name}</td>
                    <td>${box.startX}</td>
                    <td>${box.startY}</td>
                    <td>${box.endX}</td>
                    <td>${box.endY}</td>
                    <td><button onclick="removeBox(${index})">Remove</button></td>
                `;
                row.addEventListener("mouseenter", () => redrawCanvas(box));
                row.addEventListener("mouseleave", () => redrawCanvas());
            });
        }

        function removeBox(index) {
            boxes.splice(index, 1);
            redrawCanvas();
            updateTable();
        }
		
		
		
		
		 
        function downloadPascalVOC() {
            let table = document.getElementById("boundingBoxTable");
            let rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

            let filename = "image.jpg"; // Change this to match the actual image filename

            let xmlContent = `<?xml version="1.0" encoding="UTF-8"?>\n`;
            xmlContent += `<annotation>\n`;
            xmlContent += `  <folder>images</folder>\n`;
            xmlContent += `  <filename>${filename}</filename>\n`;
            xmlContent += `  <path>./${filename}</path>\n`;
            xmlContent += `  <source>\n    <database>Unknown</database>\n  </source>\n`;
            xmlContent += `  <size>\n    <width>1920</width>\n    <height>1080</height>\n    <depth>3</depth>\n  </size>\n`;
            xmlContent += `  <segmented>0</segmented>\n`;

            for (let row of rows) {
                let cells = row.getElementsByTagName("td");
                let label = cells[0].innerText;
                let xmin = cells[1].innerText;
                let ymin = cells[2].innerText;
                let xmax = cells[3].innerText;
                let ymax = cells[4].innerText;

                xmlContent += `  <object>\n`;
                xmlContent += `    <name>${label}</name>\n`;
                xmlContent += `    <pose>Unspecified</pose>\n`;
                xmlContent += `    <truncated>0</truncated>\n`;
                xmlContent += `    <difficult>0</difficult>\n`;
                xmlContent += `    <bndbox>\n`;
                xmlContent += `      <xmin>${xmin}</xmin>\n`;
                xmlContent += `      <ymin>${ymin}</ymin>\n`;
                xmlContent += `      <xmax>${xmax}</xmax>\n`;
                xmlContent += `      <ymax>${ymax}</ymax>\n`;
                xmlContent += `    </bndbox>\n`;
                xmlContent += `  </object>\n`;
            }

            xmlContent += `</annotation>`;

            let blob = new Blob([xmlContent], { type: "text/xml" });
            let link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "annotation.xml";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
        console.log("TRY GET SAVED XML", `http://13.228.134.229/labelimg/img/${imgpath}`);
        loadImage(`http://13.228.134.229/labelimg/img/${imgpath}`);
        // document.getElementById("xmlUpload").addEventListener("change", loadPascalVOC);
        console.log("TRY GET SAVED XML", `http://13.228.134.229/labelimg/data/${xmlpath}`);
        loadPascalVOC(`http://13.228.134.229/labelimg/data/${xmlpath}`);
        

//         function loadPascalVOC(event) {
//     let file = event.target.files[0];
//     if (!file) return;

//     let reader = new FileReader();
//     reader.onload = function (e) {
//         let parser = new DOMParser();
//         let xmlDoc = parser.parseFromString(e.target.result, "text/xml");

//         let objects = xmlDoc.getElementsByTagName("object");
//         boxes = []; // Clear existing boxes

//         for (let obj of objects) {
//             let name = obj.getElementsByTagName("name")[0].textContent;
//             let xmin = parseInt(obj.getElementsByTagName("xmin")[0].textContent);
//             let ymin = parseInt(obj.getElementsByTagName("ymin")[0].textContent);
//             let xmax = parseInt(obj.getElementsByTagName("xmax")[0].textContent);
//             let ymax = parseInt(obj.getElementsByTagName("ymax")[0].textContent);

//             boxes.push({ name, startX: xmin, startY: ymin, endX: xmax, endY: ymax });
//         }

//         updateTable(); // Update table with new annotations
//         redrawCanvas(); // Redraw all boxes
//     };

//     reader.readAsText(file);
// }


function loadPascalVOC(input) {
    if (typeof input === "string") {
        // Input is a URL
        fetch(input)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.text();
            })
            .then(parsePascalVOC)
            .catch(error => console.error("Error fetching XML:", error));
    } else if (input.target && input.target.files.length > 0) {
        // Input is a file upload event
        let file = input.target.files[0];
        let reader = new FileReader();
        reader.onload = function (e) {
            parsePascalVOC(e.target.result);
        };
        reader.readAsText(file);
    }
}

function parsePascalVOC(xmlString) {
    let parser = new DOMParser();
    let xmlDoc = parser.parseFromString(xmlString, "text/xml");

    let objects = xmlDoc.getElementsByTagName("object");
    boxes = []; // Clear existing boxes

    for (let obj of objects) {
        let name = obj.getElementsByTagName("name")[0].textContent;
        let xmin = parseInt(obj.getElementsByTagName("xmin")[0].textContent);
        let ymin = parseInt(obj.getElementsByTagName("ymin")[0].textContent);
        let xmax = parseInt(obj.getElementsByTagName("xmax")[0].textContent);
        let ymax = parseInt(obj.getElementsByTagName("ymax")[0].textContent);

        boxes.push({ name, startX: xmin, startY: ymin, endX: xmax, endY: ymax });
    }

    updateTable(); // Update table with new annotations
    redrawCanvas(); // Redraw all boxes
}





function savePascalVOC() {
    let table = document.getElementById("boundingBoxTable");
    let rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

    // let filename = document.getElementById("imageUpload").files[0].name || "image.jpg"; // Get image name dynamically
    
    let filename = xmlpath;
    let canvas = document.getElementById("annotationCanvas");
	let imgWidth = canvas.width;   // Get image width from canvas
	let imgHeight = canvas.height; // Get image height from canvas
    let xmlContent = `<?xml version="1.0" encoding="UTF-8"?>\n`;
    xmlContent += `<annotation>\n`;
    xmlContent += `  <folder>images</folder>\n`;
    xmlContent += `  <filename>${filename}</filename>\n`;
    xmlContent += `  <path>./${filename}</path>\n`;
    xmlContent += `  <source>\n    <database>Unknown</database>\n  </source>\n`;
    xmlContent += `  <size>\n    <width>/${imgWidth}</width>\n    <height>/${imgHeight}</height>\n    <depth>3</depth>\n  </size>\n`;
    xmlContent += `  <segmented>0</segmented>\n`;

    for (let row of rows) {
        let cells = row.getElementsByTagName("td");
        let label = cells[0].innerText;
        let xmin = cells[1].innerText;
        let ymin = cells[2].innerText;
        let xmax = cells[3].innerText;
        let ymax = cells[4].innerText;

        xmlContent += `  <object>\n`;
        xmlContent += `    <name>${label}</name>\n`;
        xmlContent += `    <pose>Unspecified</pose>\n`;
        xmlContent += `    <truncated>0</truncated>\n`;
        xmlContent += `    <difficult>0</difficult>\n`;
        xmlContent += `    <bndbox>\n`;
        xmlContent += `      <xmin>${xmin}</xmin>\n`;
        xmlContent += `      <ymin>${ymin}</ymin>\n`;
        xmlContent += `      <xmax>${xmax}</xmax>\n`;
        xmlContent += `      <ymax>${ymax}</ymax>\n`;
        xmlContent += `    </bndbox>\n`;
        xmlContent += `  </object>\n`;
    }

    xmlContent += `</annotation>`;

    // Send XML to PHP
    fetch("save_xml.php", {
        method: "POST",
        headers: { "Content-Type": "application/xml" },
        body: xmlContent
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch(error => {
        console.error("Error saving XML:", error);
        alert("Failed to save XML.");
    });
}



    </script>
</body>
</html>



