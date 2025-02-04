
<?php
$imagepath = isset($_GET['imagepath']) ? $_GET['imagepath'] : 'imagepath';

?>
<!DOCTYPE html>
<script>
lucide.createIcons();
</script>
<style>


/* Base Button Styles */
.squishy {
  position: relative;
  font-size: 1.875rem;
  padding: 0.75rem 2rem;
  font-weight: 600;
  border: none;
  cursor: pointer;
  transition: all 250ms;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
}

.squishy i {
  width: 1.75rem;
  height: 1.75rem;
}

/* Classic Squishy */
.squishy-classic {
  background-color: #f0f0f0;
  color: #242424;
  border-radius: 0.5rem;
  box-shadow: 
    inset 0 1px 0 0 #f4f4f4,
    0 1px 0 0 #efefef,
    0 2px 0 0 #ececec,
    0 4px 0 0 #e0e0e0,
    0 5px 0 0 #dedede,
    0 6px 0 0 #dcdcdc,
    0 7px 0 0 #cacaca,
    0 7px 8px 0 #cecece;
}

.squishy-classic:hover {
  transform: translateY(4px);
  box-shadow: 
    inset 0 1px 0 0 #f4f4f4,
    0 1px 0 0 #efefef,
    0 1px 0 0 #ececec,
    0 2px 0 0 #e0e0e0,
    0 2px 0 0 #dedede,
    0 3px 0 0 #dcdcdc,
    0 4px 0 0 #cacaca,
    0 4px 6px 0 #cecece;
}

/* Neon Squishy */
.squishy-neon {
  background-color: rgb(124 58 237);
  color: white;
  border-radius: 0.5rem;
  box-shadow:
    inset 0 1px 0 0 rgba(255,255,255,0.3),
    0 2px 0 0 rgb(109 40 217),
    0 4px 0 0 rgb(91 33 182),
    0 6px 0 0 rgb(76 29 149),
    0 8px 0 0 rgb(67 26 131),
    0 8px 16px 0 rgba(147,51,234,0.5);
  overflow: hidden;
}

.squishy-neon::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom, rgba(255,255,255,0.2), transparent);
}

.squishy-neon:hover {
  transform: translateY(4px);
  box-shadow:
    inset 0 1px 0 0 rgba(255,255,255,0.3),
    0 1px 0 0 rgb(109 40 217),
    0 2px 0 0 rgb(91 33 182),
    0 3px 0 0 rgb(76 29 149),
    0 4px 0 0 rgb(67 26 131),
    0 4px 8px 0 rgba(147,51,234,0.5);
}

.squishy-neon:hover i {
  animation: bounce 1s infinite;
}

/* Candy Squishy */
.squishy-candy {
  background: linear-gradient(to bottom right, rgb(244 114 182), rgb(248 113 113));
  color: white;
  border-radius: 9999px;
  box-shadow:
    inset 0 1px 0 0 rgba(255,255,255,0.4),
    0 2px 0 0 #f472b6,
    0 4px 0 0 #f43f5e,
    0 6px 0 0 #e11d48,
    0 8px 0 0 #be123c,
    0 8px 16px 0 rgba(244,114,182,0.5);
}

.squishy-candy:hover {
  transform: translateY(4px);
  box-shadow:
    inset 0 1px 0 0 rgba(255,255,255,0.4),
    0 1px 0 0 #f472b6,
    0 2px 0 0 #f43f5e,
    0 3px 0 0 #e11d48,
    0 4px 0 0 #be123c,
    0 4px 8px 0 rgba(244,114,182,0.5);
}

.squishy-candy:hover i {
  animation: pulse 1s infinite;
}

/* Cosmic Squishy */
.squishy-cosmic {
  background: linear-gradient(to right, rgb(49 46 129), rgb(88 28 135), rgb(88 28 135));
  color: white;
  border-radius: 0.5rem;
  box-shadow:
    inset 0 1px 0 0 rgba(255,255,255,0.2),
    0 2px 0 0 #312e81,
    0 4px 0 0 #1e1b4b,
    0 6px 0 0 #0f172a,
    0 8px 0 0 #020617,
    0 8px 16px 0 rgba(49,46,129,0.5);
  overflow: hidden;
}

.squishy-cosmic::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url('https://images.unsplash.com/photo-1534796636912-3b95b3ab5986?w=400&fit=crop');
  background-size: cover;
  opacity: 0.3;
  mix-blend-mode: overlay;
}

.squishy-cosmic:hover {
  transform: translateY(4px);
  box-shadow:
    inset 0 1px 0 0 rgba(255,255,255,0.2),
    0 1px 0 0 #312e81,
    0 2px 0 0 #1e1b4b,
    0 3px 0 0 #0f172a,
    0 4px 0 0 #020617,
    0 4px 8px 0 rgba(49,46,129,0.5);
}

.squishy-cosmic:hover i {
  animation: spin 1s infinite linear;
}

/* Tech Squishy */
.squishy-tech {
  background-color: rgb(5 150 105);
  color: white;
  border-radius: 0.5rem;
  box-shadow:
    inset 0 1px 0 0 rgba(255,255,255,0.3),
    0 2px 0 0 #059669,
    0 4px 0 0 #047857,
    0 6px 0 0 #065f46,
    0 8px 0 0 #064e3b,
    0 8px 16px 0 rgba(5,150,105,0.5);
  overflow: hidden;
}

.squishy-tech::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, transparent, rgba(255,255,255,0.1), transparent);
  transform: translateX(-100%);
  animation: shimmer 2s infinite;
}

.squishy-tech:hover {
  transform: translateY(4px);
  box-shadow:
    inset 0 1px 0 0 rgba(255,255,255,0.3),
    0 1px 0 0 #059669,
    0 2px 0 0 #047857,
    0 3px 0 0 #065f46,
    0 4px 0 0 #064e3b,
    0 4px 8px 0 rgba(5,150,105,0.5);
}

.squishy-tech:hover i {
  animation: bounce 1s infinite;
}

/* Animations */
@keyframes bounce {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-25%);
  }
}

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.1);
  }
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

@keyframes shimmer {
  100% {
    transform: translateX(100%);
  }
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
<input type="range" id="scaleSlider" min="0.5" max="5" step="0.1" value="1.5">

 <button class="squishy squishy-cosmic " onclick="savePascalVOC()">Save XML</button>
<button class="squishy squishy-candy" id="toggleBoxesBtn" onclick="toggleBoxes()">
    <i class="fa-solid fa-eye"></i>
</button>


   
<h4>
HORSES DIRECTION : 
"bb" back , "ll" left, "rr" right, "ff" front,"fr" front-right,"fl" front-left,"br" back-right,"bl" back-left, <br> TRUCK DIRECTION : "tbb" truck-back
"tll", "trr", "tff","tfr","tfl","tbr","tbl",<br>
GENERAL OBJ: TRUCKGATE = "gg" //  OTHER-CARS-following inner-tracklane "oo" // STATIONAIRY/PARKED CAR = "ss"
</h4>
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


            let labelMap = { "b": 0, "br": 1, "bl": 2 ,"f": 3,"fr": 4,"fl": 5,"r": 6,"l": 7,"tb": 8, "tbr": 9, "tbl": 10 ,"tf": 11,"tfr": 12,"tfl": 13,"tr": 14,"tl": 15}; // Assign unique class IDs

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
            'fr': '#FF00FF', 'fl': '#00FFFF', 'bl': '#FFA500', 'br': '#800080',

              'tl': '#FF0000', 'tr': '#00FF00', 'tf': '#0000FF', 'tb': '#FFFF00',
            'tfr': '#FF00FF', 'tfl': '#00FFFF', 'tbl': '#FFA500', 'tbr': '#800080',

'g': '#ffffff','s': '#ffffff','o': '#ffffff'

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
        if (["bb", "ll", "rr", "ff","fr","fl","br","bl","tbb", "tll", "trr", "tff","tfr","tfl","tbr","tbl","gg","oo","ss"].includes(name)) {
		  console.log(name);
		if (["ff", "ll", "rr", "bb","gg","oo","ss"].includes(name)) {
            name = name[0]; // Convert to single letter
			console.log("converted",name);
        }

        if (["tff", "tll", "trr", "tbb"].includes(name)) {
            name = name[0]+name[1]; // Convert to single letter
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
toggleBoxes();
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
                // ctx.fillStyle = "white";
                // ctx.fillRect(box.startX, box.startY - 20, ctx.measureText(box.name).width + 10, 20);
                ctx.fillStyle = "black";
                ctx.fillText(box.name, box.startX + 5, box.startY - 5);
		if (!["g", "s", "o"].includes(box.name)) {
    drawArrow(box);
		console.log("draw box :",box , color );
}            });
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
                case 'tl': arrowEndX -= 20; break;
                case 'tr': arrowEndX += 20; break;
                case 'tf': arrowEndY += 20; break;
                case 'tb': arrowEndY -= 20; break;
                case 'tfr': arrowEndX += 15; arrowEndY += 15; break;
                case 'tfl': arrowEndX -= 15; arrowEndY += 15; break;
                case 'tbl': arrowEndX -= 15; arrowEndY -= 15; break;
                case 'tbr': arrowEndX += 15; arrowEndY -= 15; break;
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



 let boxesVisible = true;

    function toggleBoxes() {
        boxesVisible = !boxesVisible;
        document.getElementById("toggleBoxesBtn").innerHTML = boxesVisible 
            ? '<i class="fa-solid fa-eye"></i>' 
            : '<i class="fa-solid fa-eye-slash"></i>';
        
        let canvas = document.getElementById("annotationCanvas");
        let ctx = canvas.getContext("2d");

        if (boxesVisible) {
            redrawCanvas();
        } else {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(document.getElementById("image"), 0, 0);
        }
    }    </script>
</body>
</html>



 