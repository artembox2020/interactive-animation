<?php
  for($i = 1 ; $i < count($this->scenarios); ++$i)
          echo " if(typeof a".$this->scenarios[$i]['id']." !== 'undefined') clearTimeout(a".$this->scenarios[$i]['id'].");";
?>
var idwn = $("#<?= $this->id ?>");
var wrapper = idwn.closest(".loader-wrapper");
wrapper.attr('style',wrapper.attr('style')+" background-image: url('<?= INT_ANIMATION_URL ?>idwn/interactive_preloader_final.png');");
setTimeout(function() { 
  var header = $("header");
  var social_icons = $(".post-content .ssba.ssba-wrap");
  var headstyle = header.attr('style');
  var social_icons_style = social_icons.attr('style');
  
  if( typeof headstyle == 'undefined' ) headstyle = "";
  if( typeof social_icons_style == 'undefined' ) social_icons_style = "";
  
  header.attr('style',headstyle+" display : block!important;");
  social_icons.attr('style', social_icons_style+" visibility: visible!important;");
    
  
  idwn.css('marginTop',idwn.attr('data-start-margin'));
  idwn.closest(".loader-wrapper").hide(); 
}, 3000);