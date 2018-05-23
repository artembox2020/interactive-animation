    function popUpAnimation<?= $this->id ?>(elem, text) {
    elem.attr('style',elem.attr('style')+' opacity: 0!important');
    elem.html(text);
    var startMargin = parseInt(elem.attr('data-start-margin')) + 60;
    var crntMargin = startMargin;
    var numberSteps = 20;
    var dopacity = 0.05;
    var hIntrvl = setInterval(function() { 
        crntMargin -= 3;
        elem.attr('style',elem.attr('style')+" margin-top : "+crntMargin+"px!important; opacity : "+(parseFloat(elem.css('opacity'))+dopacity)+"!important;");
         elem.html(text);
        --numberSteps;
        if(numberSteps <= 0)  {  elem.attr('style',elem.attr('style')+' opacity: 1!important'); elem.html(''); elem.css('marginTop',elem.attr('data-start-margin')); elem.html(text); clearInterval(hIntrvl); }
    },40);
    
}

function popDownAnimation<?= $this->id ?>(elem, text) {
    elem.attr('style',elem.attr('style')+' opacity: 1!important');
    elem.html(text);
    var startMargin = parseInt(elem.css('marginTop'));
    var crntMargin = startMargin;
    var numberSteps = 20;
    var dopacity = 0.05;
    var hIntrvl = setInterval(function() { 
        crntMargin += 3;
        elem.attr('style',elem.attr('style')+" margin-top : "+crntMargin+"px!important; opacity : "+(parseFloat(elem.css('opacity'))-dopacity)+"!important;");
         elem.html(text);
        --numberSteps;
        if(numberSteps <= 0)  {  elem.attr('style',elem.attr('style')+' opacity: 0!important');  clearInterval(hIntrvl); }
    },40);
    
}

function replaceValuePopAnimation<?= $this->id ?>(elem, oldvalue, newvalue) {
    popDownAnimation<?= $this->id ?>(elem,oldvalue);
    setTimeout(function(){ popUpAnimation<?= $this->id ?>(elem,newvalue); }, 2000);
}

    var header = $("header");

    var social_icons = $(".post-content .ssba.ssba-wrap");
    
    
    var headstyle = header.attr('style');
  
    var social_icons_style = social_icons.attr('style');
    
    if( typeof headstyle == 'undefined' ) headstyle = "";
    
    if( typeof social_icons_style == 'undefined' ) social_icons_style = "";
    
    header.attr('style',headstyle+" display : none!important;");
    social_icons.attr('style', social_icons_style+" visibility: hidden!important;");
    
    var idwn = $("#<?= $this->id ?>");
    idwn.attr('data-start-margin',idwn.css('marginTop'));
    var wrapper =  idwn.closest(".loader-wrapper");
    wrapper.attr('style',wrapper.attr('style')+" background-image: url('<?= INT_ANIMATION_URL ?>idwn/SalvageData_preloader_01.gif');");
    wrapper.css('display','inherit');
    <?php $crntInterval = 0; ?>
    <?php foreach($this->scenarios as $sce): ?>
      <?php
        if(empty($crntInterval)) {
            echo " idwn.html(\"".$sce['text']."\");";
        }
        else {
            echo "var a".$sce['id'].";";
            echo "a".$sce['id']." = setTimeout(function() { replaceValuePopAnimation".$this->id."(idwn,idwn.html(),\"".$sce['text']."\"); }, ".$crntInterval.");";
        }
        $crntInterval += $sce['time'];
      ?>
    <?php endforeach; ?>