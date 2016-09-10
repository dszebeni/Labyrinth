var canvas = document.getElementById("canvas");
var context = canvas.getContext("2d");

var currRectX = 350;
var currRectY = 50;
var mazeWidth = 500;
var mazeHeight = 500 ;
var intervalVar;
var life = 600; //600 life

var headImg=new Image();
headImg.src="head.png";

var waterImg=new Image();
waterImg.src="water.png";

var foodImg=new Image();
foodImg.src="food.png";

var canvas2 = document.getElementById("canvas2");
var ctx = canvas2.getContext("2d");
var lightx=1;

var mazeImg = new Image();
mazeImg.src = "land.gif";

function light(){
ctx.fillRect(0,0,500,500);
ctx.fillStyle="black";
ctx.clearRect(currRectX-45,currRectY-45,100,100);
}
light();

function lighton(){
    if (lightx === 0){
    ctx.clearRect(0,0,500,500);
        lightx=1;
    }
    else if (lightx === 1)
    {
        light();
        lightx=0;
    }
    
}



function drawMazeAndRectangle(rectX, rectY) {
    makeWhite(0, 0, canvas.width, canvas.height);
    
    mazeImg.onload = function () { // when the image is loaded, draw the image, the hero
        context.drawImage(mazeImg, 0, 0);
        context.drawImage(headImg,currRectX,currRectY);
        context.fillStyle="darkblue";
        context.fillRect(255,255,30,32);
        context.drawImage(waterImg,250,253);
        context.fillStyle="green";
        context.fillRect(90,127,40,35);
        context.drawImage(foodImg,90,127);
        
            context.fillStyle="white";
            context.fillRect(170,211,35,35);
       
    }
}

function drawRectangle(x, y, style) {
    makeWhite(currRectX, currRectY, 15, 15);
    currRectX = x;
    currRectY = y;
    context.beginPath();
    context.rect(x, y, 15, 15);
    context.closePath();
    context.fillStyle = style;
    context.fill();}

function makeWhite(x, y, w, h) {
    context.beginPath();
    context.rect(x, y, w, h);
    context.closePath();
    context.fillStyle = "gold";
    context.fill();
   
}

function moveRect(e) {
    var newX;
    var newY;
    var canMove;
    e = e || window.event;
    switch (e.keyCode) {
        case 38:   // arrow up key
        case 87: // W key
            newX = currRectX;
            newY = currRectY - 5;
            life=life-1;
        
            light();
            break;
        case 37: // arrow left key
        case 65: // A key
            newX = currRectX - 5;
            newY = currRectY;
            life=life-1;
            
            light();
            break;
        case 40: // arrow down key
        case 83: // S key
            newX = currRectX;
            newY = currRectY + 5;
            life=life-1;
    
            light();
            break;
        case 39: // arrow right key
        case 68: // D key
            newX = currRectX + 5;
            newY = currRectY;
            life=life-1;
        
            light();
            break;
              }
    movingAllowed = canMoveTo(newX, newY);
    if (movingAllowed === 1) {      // 1 means 'the rectangle can move'
        drawRectangle(newX, newY, "gold");
        context.drawImage(headImg,newX,newY);
        currRectX = newX;
        currRectY = newY;
   
    }
    else if (movingAllowed === 2) { // 2 means 'the rectangle reached the end point'
        clearInterval(intervalVar);
        makeWhite(0, 0, canvas.width, canvas.height);
        context.font = "40px Arial";
        context.fillStyle = "darkred";
        context.textAlign = "center";
        context.textBaseline = "middle";
        context.fillText("Congratulations!", canvas.width / 2, canvas.height / 2);
        window.removeEventListener("keydown", moveRect, true);
        ctx.clearRect(0,0,500,500);
    }
    
}

function canMoveTo(destX, destY) {
    var imgData = context.getImageData(destX, destY, 15, 15);
    var data = imgData.data;
    var canMove = 1; // 1 means: the rectangle can move
    if (destX >= 0 && destX <= mazeWidth - 15 && destY >= 0 && destY <= mazeHeight - 15) { // check whether the hero would move inside the bounds of the canvas
        for (var i = 0; i < 4 * 15 * 15; i += 4) { // look at all pixels
            if (data[i] === 0 && data[i + 1] === 0 && data[i + 2] === 0) { // black
                canMove = 0; // 0 means: the hero can't move
                break;
            }
            else if (data[i] === 255 && data[i + 1] === 255 && data[i + 2] === 255) {
                canMove = 2; // 2 means: the end point is reached
                break;
            }
            else if (data[i] === 0 && data[i + 1] === 0 && data[i + 2] === 139) {
                canMove = 1;
                lifewater();
                context.fillStyle="gold";
                context.fillRect(255,253,33,36);

                break;
            }
            else if (data[i] === 0 && data[i + 1] === 128 && data[i + 2] === 0) {
                canMove = 1;
                lifefood();
                context.fillStyle="gold";
                context.fillRect(89,127,42,36);
                
                break;
            }

        }
    }
    else {
        canMove = 0;
    }
    return canMove;
}

function createTimer(seconds) {
    intervalVar = setInterval(function () {
                              makeWhite(mazeWidth, 0, canvas.width - mazeWidth, canvas.height);
                             
                              if (seconds === 0 || life <= 0) {
                              clearInterval(intervalVar);
                              window.removeEventListener("keydown", moveRect, true);
                              makeWhite(0, 0, canvas.width, canvas.height);
                              context.font = "50px Arial";
                              context.fillStyle = "darkred";
                              context.textAlign = "center";
                              context.textBaseline = "middle";
                              context.fillText("Game Over", canvas.width / 2, canvas.height / 2);
                              ctx.clearRect(0,0,500,500);
                              return;
                              }
                             
                              context.font = "30px Arial";
                             
                              if (seconds <= 10 && seconds) {
                              context.fillStyle = "orangered";
                              }
                              else {
                              context.fillStyle = "darkred";
                              }
                              
                              context.textAlign = "center";
                              context.textBaseline = "middle";
                              
                              var minutes = Math.floor(seconds / 60);
                              var secondsToShow = (seconds - minutes * 60).toString();
                              
                              if (secondsToShow.length === 1) {
                              secondsToShow = "0" + secondsToShow;
                              }
                              context.fillText("Time", mazeWidth + 75, canvas.height - 450);
                              context.fillText(minutes.toString() + ":" + secondsToShow, mazeWidth + 75, canvas.height - 410);
                              seconds--;

                              context.fillText("Life", mazeWidth + 75, canvas.height - 250);
                              context.fillText(life, mazeWidth + 75, canvas.height - 210);
                              
                              context.font = "15px Arial";

                              context.fillText("Reach the white end point before you run out the Life or the Time.", mazeWidth + 228, canvas.height - 100);
                              context.fillText("One Water = +50 life points", mazeWidth + 100, canvas.height - 80);
                              context.fillText("One Sandwich = +150 life points", mazeWidth + 117, canvas.height - 60);
                              
                              var secs = seconds;
                      
                              var grd=context.createLinearGradient(0,0,200,0); //Timebar
                              grd.addColorStop(0,"darkred");
                              grd.addColorStop(1,"darkred");
                              context.fillStyle=grd;
                              context.fillRect(525,130,secs * 2 ,30);
                              
                              var grd=context.createLinearGradient(0,0,200,0); //Lifebar
                              grd.addColorStop(0,"darkred");
                              grd.addColorStop(1,"darkred");
                              context.fillStyle=grd;
                              context.fillRect(525,330,life /2,30);
                             
                              
                              }, 1000);
}

function lifewater(){
    life = life + 50;
}
function lifefood(){
    life = life + 150;
}

drawMazeAndRectangle(425, 3);
window.addEventListener("keydown", moveRect, true);
createTimer(120);



