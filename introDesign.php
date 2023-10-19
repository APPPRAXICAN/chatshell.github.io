<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatROOM</title>
<style>
  *{
    box-sizing: border-box;
  }
  div.lightHole {
  position : fixed;
  background-color: rgb(80,127,128) ;
  bottom : 0px ; 
  left  : 0px;
  width : 100% ; 
  height: 15px; 
  box-shadow: 30px 30px 20px 35px rgb(80,127,128);
}

[class*="circle-"]{
  padding:3px;
  border-radius: 100%;
  position: fixed;
  bottom:0px;
  background-color: rgb(80,127,128);
  animation-name: circleMotion1;
  animation-duration: 50s;
  animation-timing-function:cubic-bezier(0.1,0.1,0.1,0.1) ;
  animation-iteration-count: infinite;
  box-shadow: 1px 1px 11px 1px rgb(80,127,128);
}
@keyframes circleMotion1 {
  from{
    bottom:0px;
    opacity:1;
  }to{
    bottom:500px;
    opacity: 0;
  }
}
/*    <button class="signUP" style="margin-left:25px;" name="signUP"><h3>sginUP</h3></button>
    <button calss="signIN" style="margin-left:150px;" name="signIN"><h3>sginIN</h3></button>*/ 

</style>

</head>
<body>
<div class="circle-1" style="left:130px; padding:2px;animation-duration: 60s;"></div>
<div class="circle-2" style="left:160px;padding:2px;animation-duration: 30s;"></div>
<div class="circle-3" style="left:190px;padding:2px;animation-duration: 44s;"></div>

<div class="circle-4" style="left:220px;padding:2px;animation-duration: 39s;"></div>
<div class="circle-5" style="left:250px;padding:3px;"></div>
<div class="circle-6" style="left:280px;padding:2.5px;animation-duration: 29s;"></div>

<div class="circle-7" style="left:310px;padding:2.5px;"></div>
<div class="circle-8" style="left:340px;padding:2px;animation-duration: 41s;"></div>
<div class="circle-9" style="left:370px;padding:3px;animation-duration: 34s;"></div>

<div class="circle-10" style="left:400px;padding:2px;"></div>
<div class="circle-11" style="left:430px;padding:2px;animation-duration: 31s;"></div>
<div class="circle-12" style="left:460px;padding:2px;animation-duration: 39s;"></div>

<div class="circle-13" style="left:590px;padding:3px;animation-duration: 26s;"></div>
<div class="circle-14" style="left:520px;padding:2px;"></div>
<div class="circle-15" style="left:550px;padding:3px;animation-duration: 40s;"></div>

<div class="circle-16" style="left:680px;padding:3px;"></div>
<div class="circle-17" style="left: 710px;padding:2px;animation-duration: 33s;"></div>
<div class="circle-18" style="left:740px;padding:3px;animation-duration:55s;"></div>

<div class="circle-19" style="left:770px;padding:3px;"></div>
<div class="circle-20" style="left:800px;padding:2px;animation-duration: 37s;"></div>
<div class="circle-21" style="left:830px;padding:1.5px;animation-duration: 49s;"></div>

<div class="circle-22" style="left:860px;padding:3px;"></div>
<div class="circle-23" style="left:890px;padding:3px;animation-duration: 58s;"></div>
<div class="circle-24" style="left:920px;padding:3px;"></div>

<div class="circle-25" style="left:950px;padding:1.5px;animation-duration: 46s;"></div>
<div class="circle-26" style="left:980px;padding:3px;animation-duration: 53s;"></div>
<div class="circle-27" style="left:1010px;padding:2.5px;animation-duration: 32s;"></div>

<div class="circle-28" style="left:1040px;padding:1.9px;"></div>
<div class="circle-29" style="left:1070px;padding:2.5px;animation-duration: 60s;"></div>
<div class="circle-30" style="left:2000px;padding:3px;animation-duration: 38s;"></div>

<div class="circle-31" style="left:2030px;padding:2.5px;animation-duration: 43s;"></div>
<div class="circle-32" style="left:2060px;padding:3px;"></div>
<div class="circle-33" style="left:2090px;padding:1.8px;animation-duration: 56s;"></div>





<div class = "lightHole"></div>
     
</body>
</html>