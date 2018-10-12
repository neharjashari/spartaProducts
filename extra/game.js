setTimeout(orderReady,10000);
const levC = 9;
var pergj = "";

if(document.getElementById("emriShfrytezuesit").innerHTML !="")
{
    pergj = document.getElementById("emriShfrytezuesit").innerHTML;
}
else
{
    pergj="Super Mario";
}

var pergj2=24;

var data = new Date();
var kohaFill = data.getTime();
var kohaPerf;

var player =
{
    name: "Player",
    age: null,
    moves: 0,
    points: 0,
    fitore: function() {alert("Congratulations " + this.name + ", you have finished the game!")}
};

if(pergj!=null)
player.name = pergj;
player.age = pergj2;

var xx=0,yy=0;
var humbja = false;
var faza=1;
var speedX=0, speedY=0;
var c = document.getElementById("kanvasi");
var ctx = c.getContext("2d");
var img = document.getElementById("karakteri");
var img2 = document.getElementById("castle");
var img3 = document.getElementById("fusha");
var img4 = document.getElementById("enemy");
var img5 = document.getElementById("enemy2");
var img6 = document.getElementById("boss");
var img7 = document.getElementById("goomba");
var img8 = document.getElementById("chuck");
var victoryimg = document.getElementById("victory");

function enemy(img,posX,posY)
{
    this.img=img;
    this.posX=posX;
    this.posY=posY;
}

function enemy2(img,posX,posY,name)
{
    this.img=img;
    this.posX=posX;
    this.posY=posY;
    this.name=name;
}

function boss(img,posX,posY,name,moves,moveBool)
{
    this.img=img;
    this.posX=posX;
    this.posY=posY;
    this.name=name;
    this.moves=moves;
    this.moveBool = moveBool;
}

boss.prototype.coord = function() {return this.posX + ", " + this.posY};

var bigboss = new boss(img6,Math.floor((Math.random())*10000000)%350,Math.floor((Math.random())*10000000)%150,"Bowser",1,true);

if(bigboss.posX<50 && bigboss.posY<60)
{
    bigboss.posX=300;
    bigboss.posY=100;
}

const nrEnemy = 8;

var enemyy = new Array(nrEnemy);
for(var i=0;i<nrEnemy;i++)
{
    
    if(i%2==0)
    enemyy[i] = new enemy(img4,Math.floor((Math.random())*10000000)%460,Math.floor((Math.random())*10000000)%249);
    else
    enemyy[i] = new enemy(img5,Math.floor((Math.random())*10000000)%460,Math.floor((Math.random())*10000000)%249);
    if(enemyy[i].posX<50 || enemyy[i].posY<60)
    {
        i--;
    }
}


enemy.prototype.width = 40;
var levizjaF3=1;

window.onload = funk;

function funk()
{
    player.moves++;
    if(bigboss.moves%100==0 && levizjaF3%50==0 && bigboss.moveBool && faza==3)
    {
        alert(bigboss.name + " is tired and has stopped moving! Now is your chance!");
        bigboss.moveBool=false;
    }
    else if(bigboss.moves%100==0 && levizjaF3%50==0 && !bigboss.moveBool && faza==3)
    {
        bigboss.moveBool=true;
    }
    for(var i=0;i<nrEnemy;i++)
    {
        var lastX = enemyy[i].posX;
        var lastY = enemyy[i].posY;
        var rand = Math.floor((Math.random()*1000000)%4);
        switch(rand)
        {
            case 0:
                enemyy[i].posX+=levC;
                break;
            case 1:
                enemyy[i].posX-=levC;
                break;
            case 2:
                enemyy[i].posY-=levC;
                break;
            case 3:
                enemyy[i].posY+=levC;
                break;
        }
        if(enemyy[i].posX<0 || enemyy[i].posY<0)
        {
            enemyy[i].posX=lastX+20;
            enemyy[i].posY.lastY+20;
        }
        if(enemyy[i].posX>460 || enemyy[i].posY>260)
        {
            enemyy[i].posX=lastX-20;
            enemyy[i].posY=lastY-20;
        }
        if(enemyy[i].posX<0 || enemyy[i].posY>260)
        {
            enemyy[i].posX=lastX+20;
            enemyy[i].posY=lastY-20;
        }
        if(enemyy[i].posX>460 || enemyy[i].posY<0)
        {
            enemyy[i].posX=lastX-20;
            enemyy[i].posY=lastY+20;
        }
    }
    rand = Math.floor((Math.random()*1000000)%4);
    var lastX = bigboss.posX;
    var lastY = bigboss.posY;
    if(bigboss.moveBool && faza==3)
    {
        bigboss.moves++;
        switch(rand)
        {
            case 0:
                bigboss.posX+=levC;
                break;
            case 1:
                bigboss.posX-=levC;
                break;
            case 2:
                bigboss.posY-=levC;
                break;
            case 3:
                bigboss.posY+=levC;
                break;
        }
        if(bigboss.posX<0 || bigboss.posY<0)
        {
            bigboss.posX=lastX+21;
            bigboss.posY.lastY+21;
        }
        if(bigboss.posX>400 || bigboss.posY>200)
        {
            bigboss.posX=lastX-21;
            bigboss.posY=lastY-21;
        }
        if(bigboss.posX<0 || bigboss.posY>200)
        {
            bigboss.posX=lastX+21;
            bigboss.posY=lastY-21;
        }
        if(bigboss.posX>400 || bigboss.posY<0)
        {
            bigboss.posX=lastX-21;
            bigboss.posY=lastY+21;
        }
    }
    ctx.clearRect(0,0,500,300);
    if(faza==1)
    {
        if(xx==384 && yy==240)
        {
            faza=2;
            xx=0;
            yy=0;
        }
        ctx.drawImage(img3,0,0);
        ctx.drawImage(img2,300,100);
        ctx.drawImage(img,xx,yy);
    }
    else if(faza==2)
    {
        if(xx==384 && yy==240)
        {
            faza=3;
            xx=0;
            yy=0;
            modifyEnemies();
        }
        ctx.drawImage(img3,0,0);
        ctx.drawImage(img2,300,100);
        ctx.drawImage(img,xx,yy);
        for(var i=0;i<nrEnemy;i++)
        {
            ctx.drawImage(enemyy[i].img,enemyy[i].posX,enemyy[i].posY);
            if((enemyy[i].posX>xx-30 && enemyy[i].posX<xx+30) && (enemyy[i].posY>yy-30 && enemyy[i].posY<yy+44))
            {
                humbja=true;
                alert("You lose!");
                faza=4;
            }
        }
    }
    else if(faza==3)
    {
        levizjaF3++;
        if(xx==384 && yy==240)
        {
            faza=5;
            xx=0;
            yy=0;
        }
        ctx.drawImage(img3,0,0);
        ctx.drawImage(img2,300,100);
        ctx.drawImage(img,xx,yy);
        for(var i=0;i<nrEnemy;i++)
        {
            ctx.drawImage(enemyy[i].img,enemyy[i].posX,enemyy[i].posY);
            if((enemyy[i].posX>xx-30 && enemyy[i].posX<xx+30) && (enemyy[i].posY>yy-30 && enemyy[i].posY<yy+44))
            {
                humbja=true;
                alert("You lose!");
                faza=4;
            }
        }
        ctx.drawImage(bigboss.img,bigboss.posX,bigboss.posY);
        if(bigboss.posX>xx-120 && bigboss.posX<xx+10 && bigboss.posY>yy-120 && bigboss.posY<yy+10)
        {
            humbja=true;
            alert("You lose!");
            faza=4;
        }
    }
    else if(faza==4)
    {
        ctx.font = "30px Trebuchet MS";
        ctx.drawImage(img,224,30);
        ctx.fillStyle="black";
        ctx.fillText("YOU LOSE, " + player.name +"!",147 - player.name.length*5,120);
        ctx.fillText("Moves: " + player.moves,160,170);
        ctx.fillText("Points: " + player.points, 167,220);
        return;
    }
    else if(faza==5)
    {
        data = new Date();
        kohaPerf = data.getTime();
        if(player.moves<1200 && (kohaPerf-kohaFill)/1000<420)
        {
            player.points = ((1200-player.moves)*100) + ((420-((kohaPerf-kohaFill)/1000))*146);
        }
        else 
        {
            player.points = 100;
        }
        player.fitore();
        ctx.font = "30px Trebuchet MS";
        ctx.drawImage(victoryimg,-22,0);
        ctx.drawImage(img,224,30);
        ctx.fillStyle="black";
        ctx.fillText("YOU WIN!",180,120);
        ctx.fillText("CONGRATULATIONS " + player.name +"!",100 - player.name.length*5,170);
        ctx.fillText("Moves: " + player.moves,160,220);
        ctx.fillText("Points: " + player.points, 130,270);
        return;
    }
    setTimeout(funk,50);
}

function moveUp()
{
    yy-=8;
    if(yy<0)
    yy=0;
    funki();
}
function moveDown()
{
    yy+=8;
    if(yy>249)
    yy=248;
    funki();
}
function moveLeft()
{
    xx-=8;
    if(xx<0)
    xx=0;
    funki();
}
function moveRight()
{
    xx+=8;
    if(xx>460)
    xx=456;
    funki();
}

function whatKey(event)
{
    if(event.keyCode==38)
    {
        moveUp();
    }
    else if(event.keyCode==40)
    {
        moveDown();
    }
    else if(event.keyCode==39)
    {
        moveRight();
    }
    else if(event.keyCode==37)
    {
        moveLeft();
    }
}

function modifyEnemies()
{
    if(faza==3)
    {
        for(var i=0;i<nrEnemy;i++)
        {
            if(i%2==0)
            enemyy[i] = new enemy2(img7,Math.floor((Math.random())*10000000)%460,Math.floor((Math.random())*10000000)%249,"Goomba");
            else
            enemyy[i] = new enemy2(img8,Math.floor((Math.random())*10000000)%460,Math.floor((Math.random())*10000000)%249,"Chargin Chuck");
            if(enemyy[i].posX<50 || enemyy[i].posY<60)
            {
                i--;
            }
        }
    }
}

function orderReady()
{
    $(document).ready(function()
    {
        $("#readyOrder").show("slow",function() {alert("The order is ready")});
    });
}

