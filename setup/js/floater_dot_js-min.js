function CalibrateFloater(){WinTop=jQuery(window).scrollTop(),divBottom=WinTop+divMove+FloatThisDIV.outerHeight(!0),StopAt=StopAtThisDIV.offset().top-StopAtThisDivDistance,WinTop>divTop.toFixed(2)-divMove&&divBottom<StopAt?"fixed"!==FloatThisDIV.css("position")&&FloatThisDIV.removeAttr("style").css({position:"fixed",width:divWidth,top:divMove}):divBottom>=StopAt?"absolute"!==FloatThisDIV.css("position")&&FloatThisDIV.removeClass("floater_floating").removeAttr("style").css({position:"absolute",top:StopAt-FloatThisDIV.outerHeight(!0),width:divWidth}):FloatThisDIV.removeAttr("style")}var FloatThisDIV=jQuery(".site-header"),StopAtThisDIV=jQuery(".site-footer"),StopAtThisDivDistance=30;divMove=0;var WinTop,divTop,divWidth,divMove,divBottom,StopAt;jQuery(document).ready(function(){divTop=FloatThisDIV.offset().top,divWidth=FloatThisDIV.width(),CalibrateFloater()}),jQuery(window).scroll(function(){CalibrateFloater()});