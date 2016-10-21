<?php
/**
* Module mod_sj_html5_audiofly For Joomla 3.x
* Created by	: ExtensionSpot
* Email			: support@ExtensionSpot.net
* Created on	: 05 Feb 2013
* Last Modified : 21 April 2015
* URL			: www.ExtensionSpot.net
* Copyright (C) 2011-2013  ExtensionSpot
* License GPLv2.0 - http://www.gnu.org/licenses/gpl-2.0.html
*/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
$LiveSite 	= JURI::base();
$module_path=$LiveSite.'modules/mod_sj_html5_audiofly/';



$selitembgcolor=$params->get('selitembgcolors');
$selitemtxtcolor=$params->get('selitemtxtcolor');
$plbgcolor=$params->get('plbgcolor');
$pltxtcolor=$params->get('pltxtcolor');
$plopen=$params->get('plopen');
$plrepeat=$params->get('plrepeat');
$displaydwld=$params->get('displaydwld');
$download_icon=$params->get('download_icon');
$mymusictxt=$params->get('mymusictxt');
$flloadjq=$params->get('flloadjq');

$fly_top_bott=$params->get('fly_top_bott', 'bottom');
if($fly_top_bott=="top"){

}else{
$flybottom='bottom:0;';
};
$fly_sticky='fixed';
require(JModuleHelper::getLayoutPath('mod_sj_html5_audiofly'));
$document = JFactory::getDocument();
$document->addStyleSheet($module_path.'/css/sj_html5_audiofly_style.css');
/***PERFECT SCROLLBAR**/
	JHtml::script($module_path.'js/perfect-scrollbar.jquery.min.js');
	JHtml::script($module_path.'js/perfect-scrollbar.min.js');
	$document->addStyleSheet($module_path.'css/perfect-scrollbar.min.css');
 /*****/
 /**JSCROLLPANE***/
 if($flloadjq=='yes'){
JHtml::script($module_path.'js/jquery-1.8.3.min.js');
}

 
//JHtml::script($module_path.'js/noc.js');
 
 
 
 
  /*****/
?>
<!---
<script type="text/javascript" language="javascript" src="<?php //echo $LiveSite; ?>modules/mod_sj_html5_audiofly/js/jquery-1.8.3.min.js"></script>
-->
<link rel="stylesheet" href="<?php echo $module_path?>/css/handheld_fly.css" media="handheld"/>
<link media="only screen and (max-device-width: 480px)" 
    href="<?php echo $module_path?>/css/handheld_fly.css" type="text/css" rel="stylesheet" />
<div id="cwrap" >

	 <div id="audiowrap">
	  <span id="extraControls">
	  <input type="hidden" id="sduration"/>
            <div id="btnPrev" class="ctrlbtn"></div>
			<div id="btnPlay" class="ctrlbtn"></div>
			<div id="btnPause" class="ctrlbtn"></div>
			<div id="btnNext" class="ctrlbtn"></div>
			<div id="progressBar"><span id="progresss"></span></div>
			<div id="playlist"></div>
			<div id="tracktime">0:00</div>
			<div id="mute" class="unmuted" ></div>
			<div id="audioVolume"><div id="volp"></div></div>
			<div id="opmodal"  class="hidden">Open modal</div>	
       </div>
        <div id="audio0">
            <audio id="audio1" >
                Your browser does not support the HTML5 Audio Tag.
            </audio>
        </div>
    <div id="plwrap" class="<?php echo $plopen ?>">
		<div id="plwrap_inner" class="<?php //echo $plopen ?>">
			<ul id="plUL" class="<?php echo $plopen ?>">
			</ul>
		</div>			
	<div id="clear_history" class="clear_history hidden">Clear Library</div>	
	</div>
</div>
        <script type="text/javascript">
		var sjfly = jQuery.noConflict();
var modal = (function(){
				var 
				method = {},
				$overlay,
				$modal,
				$content_modal,
				$close;
				method.center = function () {
				var top, left;
					left = Math.max(sjfly(window).width() - $modal.outerWidth(), 0) / 2;
					$modal.css({
						left:left + sjfly(window).scrollLeft()
					});
				};
				method.open = function (settings) {
					$content_modal.empty().append(settings.content_modal);
					$modal.css({
						width: settings.width || 'auto', 
						height: settings.height || 'auto'
					});
					method.center();
					sjfly(window).bind('resize.modal', method.center);
					$modal.show();
					$overlay.show();
				};
				method.close = function () {
					$modal.hide();
					$overlay.hide();
					$content_modal.empty();
					sjfly(window).unbind('resize.modal');
				};
				$overlay = sjfly('<div id="overlay"></div>');
				$modal = sjfly('<div id="modal"><div class="openlib" style=""><?php echo $mymusictxt ?>&nbsp&nbsp&nbsp&nbsp&nbsp</div></div>');
				
				$content_modal = sjfly('<div id="content_modal"></div>');
				$close = sjfly('<a id="closes" href="#" style="display:none;">close</a>');
				 // $modal.hide();
				$overlay.hide();
				 // $modal.append($content_modal);
				 $modal.append($close);
				sjfly(document).ready(function(){
					sjfly('body').append($overlay, $modal);						
				});
				$close.click(function(e){
					e.preventDefault();
					method.close();
				});
				return method;
			}());	
			sjfly(function(sjfly) {
				var supportsAudio = !!document.createElement('audio').canPlayType;
				if(supportsAudio) {	
audioPlay=document.getElementById('btnPlay');
audioPause=document.getElementById('btnPause');							
		dowloadlink='';
		
		
				j_number=0;
				/**Open lib**/
sjfly('.openlib').click(function(e) {
sjfly('#cwrap').removeClass('hidden');	
sjfly('#cwrap').addClass('hidden');		
if(trackCount>=0 && sjfly('#plUL').hasClass('nehidden')){
sjfly('#clear_history').removeClass('hidden');
sjfly('#clear_history').addClass('nehidden');
};
trackCount = tracks.length
localStorage.setItem('pl_history',JSON.stringify(tracks));	
	loadTrack(0);
	
			//audio.play();
	document.getElementById('sduration').value='';
document.getElementById('plLength123').innerHTML ='';

audioPause.style.display='none';
audioPlay.style.display='inline';		
		
 e.preventDefault();
				
	sjfly('#plwrap').show();
	sjfly('#audiowrap').show();
	sjfly('#closes').show();			
	sjfly('#plwrap_inner').show();			
});				
				
				/***Butoane*/
				sjfly('.butoane').click(function(e) {
				
sjfly('#cwrap').removeClass('hidden');	
sjfly('#cwrap').addClass('hidden');		
		

if(trackCount>=0 && sjfly('#plUL').hasClass('nehidden')){
sjfly('#clear_history').removeClass('hidden');
sjfly('#clear_history').addClass('nehidden');
};	
	
				j_number++;		
var adddiv=e.target;
var songname=adddiv.getAttribute("data-songname");
var dwlink=adddiv.getAttribute("data-dwlink");
var mediaPath=adddiv.getAttribute("data-mediaPath");
var mp3drop=adddiv.getAttribute("data-mp3drop");
var oggdrop=adddiv.getAttribute("data-oggdrop");
var obj={"track":j_number,"name":songname,"file":songname,"mediaPath":mediaPath,"dwlink":dwlink,"mp3drop":mp3drop,"oggdrop":oggdrop};		
				tracks.push(obj);
				trackCount = tracks.length
localStorage.setItem('pl_history',JSON.stringify(tracks));				
mypl=document.getElementById('plUL');
		sjfly('<li><div class="plItem" onClick="play('+j_number+')"><div class="plNum">'+j_number+' - </div><div class="plTitle">'+songname+'</div><div class="plLength" id="plLength"></div></div><div id="aditional_holder"><a id="download" href="'+dwlink+'" target="_blank"></a></div></li>').appendTo(mypl);
			loadTrack(trackCount-1);	
			audio.play();	
			
document.getElementById('sduration').value='';
document.getElementById('plLength123').innerHTML ='';

audioPause.style.display='inline';
audioPlay.style.display='none';	



		
				 e.preventDefault();
		
sjfly('#plwrap').show();
	sjfly('#audiowrap').show();
	sjfly('#closes').show();		
sjfly('#plwrap_inner').show();
var container=document.getElementById("plwrap_inner");

 setTimeout(
  function() 
  {
	  Ps.destroy(container);
	  Ps.initialize(container, {
  wheelSpeed: 0.3,
	  wheelPropagation: false});
	Ps.update(container);  
	  }, 5);
 setTimeout(
  function() 
  {
   
 if(trackCount>13){
	  Ps.update(container);
container.scrollTop = (container.scrollHeight)-300;
};
 }, 5);

	 

				});	
				/**Playall_class**/
				sjfly('.playall_class').click(function(e) {
					
	sjfly('#cwrap').removeClass('hidden');	
sjfly('#cwrap').addClass('hidden');		
				

if(trackCount>=0 && sjfly('#plUL').hasClass('nehidden')){
sjfly('#clear_history').removeClass('hidden');
sjfly('#clear_history').addClass('nehidden');
};	
// sjfly('#plUL').empty();
// tracks=[];
// localStorage.clear();

	var adddiv=e.target;
					var prev=sjfly(adddiv).prev();
					var previd=prev[0].id
		var numItems = sjfly('#'+previd+' .butoane').length;
					 
		var itemsinpl=sjfly('#'+previd+' .butoane');	
		 
		var pllenght='';
		sjfly.each(itemsinpl, function(indez,gadereddata){
			 
			j_number++;
var songname=gadereddata.getAttribute("data-songname");
var dwlink=gadereddata.getAttribute("data-dwlink");
var mediaPath=gadereddata.getAttribute("data-mediaPath");
var mp3drop=gadereddata.getAttribute("data-mp3drop");
var oggdrop=gadereddata.getAttribute("data-oggdrop");
		var objc={"track":j_number,"name":songname,"file":songname,"mediaPath":mediaPath,"dwlink":dwlink,"mp3drop":mp3drop,"oggdrop":oggdrop};				
				tracks.push(objc);
				trackCount = tracks.length
				localStorage.setItem('pl_history',JSON.stringify(tracks));				
mypl=document.getElementById('plUL');
sjfly('<li><div class="plItem" onClick="play('+j_number+')"><div class="plNum">'+j_number+' - </div><div class="plTitle">'+songname+'</div><div class="plLength" id="plLength"></div></div><div id="aditional_holder"><a id="download" href="'+dwlink+'" target="_blank"></a></div></li>').appendTo(mypl);
			pllenght=indez+1;
			})
			var toplay=(tracks.length)-pllenght;
			loadTrack(toplay);
			  audio.play();	
				
document.getElementById('sduration').value='';
document.getElementById('plLength123').innerHTML ='';

audioPause.style.display='inline';
audioPlay.style.display='none';	



	
				e.preventDefault();
		

sjfly('#plwrap').show();
sjfly('#audiowrap').show();
sjfly('#closes').show();	
sjfly('#plwrap_inner').show();	


var container=document.getElementById("plwrap_inner");


 setTimeout(
  function() 
  {
	  Ps.destroy(container);
	  Ps.initialize(container, {
  wheelSpeed: 0.3,
	  wheelPropagation: false});
	Ps.update(container);  
	  }, 5);
setTimeout(
  function() 
  {
if(trackCount>13){	
	var plheight=pllenght*23;
container.scrollTop = ((container.scrollHeight)-(300+plheight-(23*13)));
	};
 }, 5);
 

					
				});
				/***/

				/***/
					var index = 0,
					playing = false;
					extension = '',
					dropvar = '',
					tracks = [	
					],
					trackCount = tracks.length,				
					npTitle = sjfly('#npTitle'),
					audio = sjfly('#audio1').bind('play', function() {
						playing = true;	
audioPause.style.display='inline';
audioPlay.style.display='none';	
showtime();					
					}).bind('pause', function() {
						playing = false;
audioPause.style.display='none';
audioPlay.style.display='inline';						
					}).bind('ended', function() {
												
						if((index + 1) < trackCount) {
							index++;
							loadTrack(index);
							audio.play();

audioPause.style.display='inline';
audioPlay.style.display='none';							
						} else {
						index = 0;
						loadTrack(index);
						audio.<?php echo $plrepeat ?>();       
audioPause.style.display='none';
audioPlay.style.display='inline';							
						}
					}).get(0),
					btnPrev = sjfly('#btnPrev').click(function() {
						if((index - 1) > -1) {
							index--;
							loadTrack(index);
							if(playing) {
								audio.play();
								
audioPause.style.display='inline';
audioPlay.style.display='none';
							}
						} else {
							audio.pause();
							index = 0;
							loadTrack(index);
audioPause.style.display='none';
audioPlay.style.display='inline';							
						}
					}),
					btnNext = sjfly('#btnNext').click(function() {
						if((index + 1) < trackCount) {
							index++;
							loadTrack(index);
							if(playing) {
								audio.play();
audioPause.style.display='inline';
audioPlay.style.display='none';
							}
						} else {
							audio.pause();
							index = 0;
							loadTrack(index);
audioPause.style.display='none';
audioPlay.style.display='inline';
						}
					}),
					
					loadTrack = function(id) {
						sjfly('.plSel').removeClass('plSel');
						sjfly('div.plLength').attr('id', '');
						sjfly('#plUL li:eq(' + id + ')').addClass('plSel');
						sjfly('.plLength:eq(' + id + ')').attr('id', 'plLength123');
						if (tracks[id]!=null){
						npTitle.text(tracks[id].name);
						index = id;
						// if (extension=='mp3'){alert('mp3');}else{alert('ogg');}
						if(audio.canPlayType('audio/ogg')) {dropvar=tracks[id].oggdrop}
						if(audio.canPlayType('audio/mpeg')) {dropvar=tracks[id].mp3drop}
						
						audio.src = tracks[id].mediaPath+dropvar+ tracks[id].file + extension;
						
						dowloadlink=tracks[id].dwlink;
						};
					},
					playTrack = function(id) {
						loadTrack(id);
						audio.play();
audioPause.style.display='inline';
audioPlay.style.display='none';						
					};
				
if(localStorage.getItem('pl_history')){
storagedata = localStorage.getItem('pl_history');
history_objects=JSON.parse(storagedata);
Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};
var objects_lenght = Object.size(history_objects);
for(var i=0;i<objects_lenght;i++){
j_number++;
tracks.push(history_objects[i]);
mypl=document.getElementById('plUL');
	sjfly('<li><div class="plItem" onClick="play('+j_number+')"><div class="plNum">'+j_number+' - </div><div class="plTitle">'+history_objects[i].name+'</div><div class="plLength" id="plLength"></div></div><div id="aditional_holder"><a id="download" href="'+history_objects[i].dwlink+'" target="_blank"></a></div></li>').appendTo(mypl);
	
}
sjfly('.plLength a').click(function(e){
 e.stopPropagation();
});
trackCount = tracks.length
loadTrack(trackCount-1);
audioPause.style.display='none';
audioPlay.style.display='inline';	
};			
sjfly('.clear_history').click(function() {
audio.pause();
sjfly('#plUL').empty();
tracks=[];
localStorage.clear();
j_number=0;
sjfly('#clear_history').removeClass('nehidden');
sjfly('#clear_history').addClass('hidden');
sjfly('.ps-scrollbar-y-rail').css('height','0');
sjfly('.ps-scrollbar-y').css('height','0');
});					
sjfly('#btnPlay').click(function() {
audio.play();
audioPause.style.display='inline';
audioPlay.style.display='none';
});
sjfly('#btnPause').click(function(){ 
audio.pause();	
audioPause.style.display='none';
audioPlay.style.display='inline';
});
function updateProgress() {
   var progresss = document.getElementById("progresss");
   var value = 0;
   if (audio.currentTime > 0) {
      value = parseInt((100 / audio.duration) * audio.currentTime);
   }
   progresss.style.width = value + "%";
}
audio.addEventListener("timeupdate", updateProgress, false);
sjfly('#progressBar').click(function(e){
 var posX = sjfly(this).offset().left;
position=e.pageX - posX;
duration=audio.duration;
seekPosition=(position/200) * duration;
audio.currentTime=seekPosition;
});
function secondsToHms(d) {
d = Number(d);
var h = Math.floor(d / 3600);
var m = Math.floor(d % 3600 / 60);
var s = Math.floor(d % 3600 % 60);
return ((h > 0 ? h + ":" : "") + (m > 0 ? (h > 0 && m < 10 ? "0" : "") + m + ":" : "0:") + (s < 10 ? "0" : "") + s); };
function updateTime(){
document.getElementById('tracktime').innerHTML = secondsToHms(parseInt(this.currentTime));
durationsec=secondsToHms(parseInt(this.duration));
document.getElementById('sduration').value=durationsec;
}
audio.addEventListener("timeupdate", updateTime, false);
sjfly('#audioVolume').click(function(e){
 var posX = sjfly(this).offset().left;
volp=document.getElementById('volp');
position=e.pageX - posX;
seekPosition=(position*2);
 volp.style.width = seekPosition + "%";
 audio.volume=seekPosition/100;
 if(audio.muted==true & volp.style.width >= 1+"%"){ 
 audio.muted=false;
  sjfly('#mute').removeClass('muted');
   sjfly('#mute').addClass('unmuted');
 } ;
});
sjfly('#mute').click(function(){
   audio.muted = !audio.muted;
  volpw=audio.volume;
   if(audio.muted==true){
   sjfly('#mute').removeClass('unmuted');
   sjfly('#mute').addClass('muted');
     volp.style.width =0+ "%";
      }else{
volp.style.width =volpw*100+"%";
   sjfly('#mute').removeClass('muted');
   sjfly('#mute').addClass('unmuted');
	  };
});
plwrap=document.getElementById('plwrap');
audiowrap=document.getElementById('audiowrap');
close_btn=document.getElementById('closes');
function clickhidden(){
sjfly('#opmodal').click();


};
sjfly('#modal').append(plwrap);
sjfly('#modal').append(close_btn);
sjfly('#opmodal').click(function(){
sjfly('#modal').append(plwrap);
 });
 sjfly('.butoane').click(function(e){
sjfly('#modal').append(audiowrap);
modal.open({content_modal: ''});
e.preventDefault();
 sjfly('.openlib').hide();
 });
 sjfly('.playall_class').click(function(e) {
sjfly('#modal').append(audiowrap);
modal.open({content_modal: ''});
e.preventDefault();	 
	  sjfly('.openlib').hide();
 });
  sjfly('.openlib').click(function(e) {
sjfly('#modal').append(audiowrap);
modal.open({content_modal: ''});
e.preventDefault();	 
	  sjfly('.openlib').hide();
 });
sjfly('#playlist').click(function(){
if(sjfly('#plUL').hasClass('hidden')){
clickhidden();
sjfly('#clear_history').removeClass('hidden');
sjfly('#clear_history').addClass('nehidden');

 sjfly('#plUL').removeClass('hidden');
 sjfly('#plUL').addClass('nehidden');

 sjfly('#plwrap').removeClass('hidden');
 sjfly('#plwrap').addClass('nehidden');
 
 var container=document.getElementById("plwrap_inner");
Ps.initialize(container);
container.scrollTop = (container.scrollHeight)-300;
Ps.update(container);	
 
}else{
sjfly('#plUL').removeClass('nehidden');
 sjfly('#plUL').addClass('hidden');
 sjfly('#clear_history').removeClass('nehidden');
 sjfly('#clear_history').addClass('hidden');
 
 sjfly('#plwrap').removeClass('nehidden');
 sjfly('#plwrap').addClass('hidden');
}
});
sjfly('#download').click(function(){
	window.open(dowloadlink,'_blank');
});
sjfly('#closes').click(function(){
	audio.pause();
	
	sjfly('#modal').show();
	sjfly('#modal').css('left','50%');
	
	showOpenLib();
	//sjfly('.openlib').show();
	// sjfly('#overlay').hide();
	sjfly('#plwrap').hide();
	sjfly('#audiowrap').hide();
	sjfly('#closes').hide();
});
					if(audio.canPlayType('audio/ogg')) {
						extension = '.ogg';
					}
					if(audio.canPlayType('audio/mpeg')) {
						extension = '.mp3';
					}
					loadTrack(index);
				};
			});
			
		
			
// var cwrapdiv = document.getElementById("cwrap");
// var downloaddiv = document.getElementById("download");

// downloadwidth=downloaddiv.offsetWidth;

//cwrapwidth=495+downloadwidth;			
//cwrapdiv.style.width=cwrapwidth+'px';
// cwrapdiv.addClass('hidden');		
	
sjfly('#cwrap').addClass('hidden');			
	sjfly('#plwrap').hide();
	sjfly('#audiowrap').hide();
	sjfly('#closes').hide();
	/**Click and play**/
	function play(e){
	//var id = parseInt(sjfly(this).index());
		  playTrack(e-1);
		  showtime();
		
	}
			
		/*	
		sjfly('#plUL').on('click', 'li', function () {
    var id = parseInt(sjfly(this).index());
		  playTrack(id);
		  showtime();
});
*/
/*
sjfly('.plItem').click( function () {
   console.log(this);
   var id = parseInt(sjfly(this).index());
   console.log(id);
});

		
		sjfly('.plItem').click(function() {
			alert(this);	
    var id = parseInt(sjfly(this).index());

		  playTrack(id);
		  showtime();
});


*/
 function showtime(){
	 setTimeout(function(){
		activetimer=document.getElementById('plLength123');
		durationfield=document.getElementById('sduration');

		if (durationfield!='0:NaN'){
			activetimer.innerHTML = durationfield.value;
		}else{activetimer.innerHTML = '0:00';}

	},1000);
	 
 }

	function showOpenLib(){

	if(sjfly('#plUL li').length==0){
			
			sjfly('.openlib').css('display','none');
			}else{
				sjfly('.openlib').show();
				};
				}
				
	
				
sjfly( document ).ready(function() {
    showOpenLib();
	
sjfly(function() {
	 
	var container=document.getElementById("plwrap_inner");
	 Ps.initialize(container, {
  wheelSpeed: 0.3,
	  wheelPropagation: false});
	 Ps.update(container);

	
	
	
});	
	
	
});
				
				/***/
	
		</script>						
<p></p>
<?php
	//===========Backgrounds=============//
	$use_bg_fly=$params->get('use_bg_fly');
	$gradient_orientation=$params->get('gradient_orientation');
	
	$item_bg_color_flyi=$params->get('item_bg_color_flyi');
	$item_bg_color_flyii=$params->get('item_bg_color_flyii');
	$item_bg_color_flyiii=$params->get('item_bg_color_flyiii');
if($gradient_orientation=='vertical'){
	$type='linear';
	$startfromff3='top';
	$startfromchrome='left top';
	$endto='left bottom';
	$radialchrome='';
	$elcover='';
	$startw3c='to bottom';
	$iegrtype='0';
}else if($gradient_orientation=='horizontal'){
	$type='linear';
	$startfromff3='left';
	$startfromchrome='left top';
	$endto='right top';
	$radialchrome='';
	$elcover='';
	$startw3c='to right';
	$iegrtype='1';
}else if($gradient_orientation=='diagonalright'){
	$type='linear';
	$startfromff3='-45deg';
	$startfromchrome='left top';
	$endto='right bottom';
	$radialchrome='';
	$elcover='';
	$startw3c='135deg';
	$iegrtype='1';
}else if($gradient_orientation=='diagonalleft'){
	$type='linear';
	$startfromff3='45deg';
	$startfromchrome='left bottom';
	$endto='right top';
	$radialchrome='';
	$elcover='';
	$startw3c='45deg';
	$iegrtype='1';
}else if($gradient_orientation=='radial'){
	$type='radial';
	$startfromff3='center';
	$startfromchrome='center center';
	$endto='0px';
	$radialchrome='center center, 100%,';
	$elcover='ellipse cover,';
	$startw3c='ellipse at center';
	$iegrtype='1';
}

	
$color1=$item_bg_color_flyi;
$color2=$item_bg_color_flyii;
$color3=$item_bg_color_flyiii;
	
	
	if($use_bg_fly=='gradientiii'){
		$background_gradient='
		background: '.$color1.'; 
background: -moz-'.$type.'-gradient('.$startfromff3.','.$elcover.' '.$color1.' 0%, '.$color2.' 50%, '.$color3.' 100%); /
background: -webkit-gradient('.$type.', '.$startfromchrome.', '.$endto.','.$radialchrome.' color-stop(0%,'.$color1.'), color-stop(50%,'.$color2.'), color-stop(100%,'.$color3.')); 
background: -webkit-'.$type.'-gradient('.$startfromff3.','.$elcover.' '.$color1.' 0%,'.$color2.' 50%,'.$color3.' 100%); 
background: -o-'.$type.'-gradient('.$startfromff3.','.$elcover.' '.$color1.' 0%,'.$color2.' 50%,'.$color3.' 100%);
background: -ms-'.$type.'-gradient('.$startfromff3.','.$elcover.' '.$color1.' 0%,'.$color2.' 50%,'.$color3.' 100%);
background: '.$type.'-gradient('.$startw3c.', '.$color1.' 0%,'.$color2.' 50%,'.$color3.' 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\''.$color1.'\', endColorstr=\''.$color3.'\',GradientType='.$iegrtype.' ); 

		';
	}else if($use_bg_fly=='gradientii'){
		
				$background_gradient='
		background: '.$color1.'; 
background: -moz-'.$type.'-gradient('.$startfromff3.','.$elcover.' '.$color1.' 0%, '.$color2.' 100%); /
background: -webkit-gradient('.$type.', '.$startfromchrome.', '.$endto.','.$radialchrome.' color-stop(0%,'.$color1.'), color-stop(100%,'.$color2.')); 
background: -webkit-'.$type.'-gradient('.$startfromff3.','.$elcover.' '.$color1.' 0%,'.$color2.' 100%); 
background: -o-'.$type.'-gradient('.$startfromff3.','.$elcover.' '.$color1.' 0%,'.$color2.' 100%);
background: -ms-'.$type.'-gradient('.$startfromff3.','.$elcover.' '.$color1.' 0%,'.$color2.' 100%);
background: '.$type.'-gradient('.$startw3c.', '.$color1.' 0%,'.$color2.' 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\''.$color1.'\', endColorstr=\''.$color2.'\',GradientType='.$iegrtype.' ); 
';
			$background_gradient_hover='
		background: '.$color1.'; 
background: -moz-'.$type.'-gradient('.$startfromff3.','.$elcover.' '.$color2.' 0%, '.$color1.' 100%); /
background: -webkit-gradient('.$type.', '.$startfromchrome.', '.$endto.','.$radialchrome.' color-stop(0%,'.$color2.'), color-stop(100%,'.$color1.')); 
background: -webkit-'.$type.'-gradient('.$startfromff3.','.$elcover.' '.$color2.' 0%,'.$color1.' 100%); 
background: -o-'.$type.'-gradient('.$startfromff3.','.$elcover.' '.$color2.' 0%,'.$color1.' 100%);
background: -ms-'.$type.'-gradient('.$startfromff3.','.$elcover.' '.$color2.' 0%,'.$color1.' 100%);
background: '.$type.'-gradient('.$startw3c.', '.$color2.' 0%,'.$color1.' 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\''.$color2.'\', endColorstr=\''.$color1.'\',GradientType='.$iegrtype.' ); 
';
	}else if($use_bg_fly=='flat'){
		$background_gradient='background: '.$color1.'; ';
	}else if($use_bg_fly=='none'){
		$background_gradient='';
	}





if(isset($flybottom)){
$plwrapbottom=$flybottom+46;
echo"
<style>
#audiowrap{
bottom:$flybottom"."px;
-moz-box-shadow: 2px -2px 15px #333;
	-webkit-box-shadow: 2px -2px 15px #333;
	box-shadow: 2px -2px 15px #333;
}
#plwrap{
position:absolute;
bottom:$plwrapbottom"."px;
-moz-box-shadow: 2px -2px 15px #333;
	-webkit-box-shadow: 2px -2px 15px #333;
	box-shadow: 2px -2px 15px #333;
}
#modal {
padding-bottom:8px;
}
</style>
<script>
var audiowrapdiv = document.getElementById('audiowrap');
var downloaddiv = document.getElementById('plwrap');	
//audiowrapdiv.style.width=cwrapwidth+'px';
//plwrap.style.width=cwrapwidth+'px';
plwrap.style.width='100%';
</script>
";
};
echo "
<style>
#audiowrap{
-moz-box-shadow: 2px -2px 15px #333;
	-webkit-box-shadow: 2px -2px 15px #333;
	box-shadow: 2px -2px 15px #333;
	$background_gradient;
	font-size: 0.8em;
  line-height: 1em;
  	
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  
  border-left:5px groove $plbgcolor;
  border-right:5px groove $plbgcolor;

  
}
#plwrap{
-moz-box-shadow: 2px -2px 15px #333;
	-webkit-box-shadow: 2px -2px 15px #333;
	box-shadow: 2px -2px 15px #333;
	
	border-width: 5px;
	  border-bottom: 0;
  border-style: groove;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
	
	border-color: $plbgcolor ;
	
  
}
.plSel{
background:$selitembgcolor !important;
color:$selitemtxtcolor !important;
}
#plUL li {
	
	$background_gradient;
	font-size: 0.8em;
  line-height: 1em;
// background:$plbgcolor ;
color:$pltxtcolor;
display:table;
width:100%;
}
#download{

  background: url('$module_path/images/dwldicons/$download_icon') no-repeat center center;
  background-size: contain;
    width: 56%;
  height: 16px;
  float: left ;
 
}
#aditional_holder{
display:$displaydwld;
  
  vertical-align: middle;
	width: 6%;
 
  }
#modal {
	position:$fly_sticky;
	
	//background:$plbgcolor;
	$background_gradient;
	color:$pltxtcolor;
	padding-top:8px;	

$flybottom 
left:50%;
border-top-left-radius: 5px;
border-top-right-radius: 5px;
}
.clear_history{
cursor:pointer;
background:$plbgcolor;
color:$pltxtcolor;
border-left: 150px solid #ccc;
border-right: 150px solid #ccc;
border-image: url($module_path/images/_player-bg4.png);
text-align: center;
font-size: 0.8em;
}
.clear_history:hover{
color:$selitemtxtcolor;
text-decoration:underline;
}
.plLength a{
background:none;
font-weight:normal;
}
.openlib{
// height: 24px;
padding-left:5px;
display: table-cell; vertical-align: middle;
cursor:pointer;
// margin-top: -8px;
  // margin-bottom: -8px;
background:url('$module_path/images/aud.png') no-repeat right center;
//transform: rotate(90deg);

}
</style>
";
?>