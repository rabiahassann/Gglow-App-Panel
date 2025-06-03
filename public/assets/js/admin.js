(function($){"use strict";var $wrapper=$('.main-wrapper');var $pageWrapper=$('.page-wrapper');var $slimScrolls=$('.slimscroll');var Sidemenu=function(){this.$menuItem=$('#sidebar-menu a');};function init(){var $this=Sidemenu;$('#sidebar-menu a').on('click',function(e){if($(this).parent().hasClass('submenu')){e.preventDefault();}
if(!$(this).hasClass('subdrop')){$('ul',$(this).parents('ul:first')).slideUp(350);$('a',$(this).parents('ul:first')).removeClass('subdrop');$(this).next('ul').slideDown(350);$(this).addClass('subdrop');}else if($(this).hasClass('subdrop')){$(this).removeClass('subdrop');$(this).next('ul').slideUp(350);}});$('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');}
init();$('body').append('<div class="sidebar-overlay"></div>');$(document).on('click','#mobile_btn',function(){$wrapper.toggleClass('slide-nav');$('.sidebar-overlay').toggleClass('opened');$('html').addClass('menu-opened');return false;});$(".sidebar-overlay").on("click",function(){$wrapper.removeClass('slide-nav');$(".sidebar-overlay").removeClass("opened");$('html').removeClass('menu-opened');});$(function(){$("input[name='mail_config']").click(function(){if($("#chkYes").is(":checked")){$("#showemail").show();}else{$("#showemail").hide();}});});if($('#editor').length>0){ClassicEditor.create(document.querySelector('#editor'),{toolbar:['bold','italic','link']}).then(editor=>{window.editor=editor;}).catch(err=>{console.error(err.stack);});}
if($('.select').length>0){$('.select').select2({minimumResultsForSearch:-1,width:'100%'});}
$(document).on('click','#filter_search',function(){$('#filter_inputs').slideToggle("slow");});if($('.datetimepicker').length>0){$('.datetimepicker').datetimepicker({format:'DD-MM-YYYY',icons:{up:"fas fa-angle-up",down:"fas fa-angle-down",next:'fas fa-angle-right',previous:'fas fa-angle-left'}});}
if($('[data-toggle="tooltip"]').length>0){$('[data-toggle="tooltip"]').tooltip();}
if($('.datatable').length>0){$('.datatable').DataTable({"bFilter":false,});}
if($('.images-carousel').length>0){$('.images-carousel').owlCarousel({loop:true,center:true,margin:10,responsiveClass:true,responsive:{0:{items:1},600:{items:1},1000:{items:1,loop:false,margin:20}}});}
if($slimScrolls.length>0){$slimScrolls.slimScroll({height:'auto',width:'100%',position:'right',size:'7px',color:'#ccc',allowPageScroll:false,wheelStep:10,touchScrollStep:100});var wHeight=$(window).height()-60;$slimScrolls.height(wHeight);$('.sidebar .slimScrollDiv').height(wHeight);$(window).resize(function(){var rHeight=$(window).height()-60;$slimScrolls.height(rHeight);$('.sidebar .slimScrollDiv').height(rHeight);});}
$(document).on('click','#toggle_btn',function(){if($('body').hasClass('mini-sidebar')){$('body').removeClass('mini-sidebar');$('.subdrop + ul').slideDown();}else{$('body').addClass('mini-sidebar');$('.subdrop + ul').slideUp();}
setTimeout(function(){mA.redraw();mL.redraw();},300);return false;});$(document).on('mouseover',function(e){e.stopPropagation();if($('body').hasClass('mini-sidebar')&&$('#toggle_btn').is(':visible')){var targ=$(e.target).closest('.sidebar').length;if(targ){$('body').addClass('expand-menu');$('.subdrop + ul').slideDown();}else{$('body').removeClass('expand-menu');$('.subdrop + ul').slideUp();}
return false;}
$(window).scroll(function(){if($(window).scrollTop()>=30){$('.header').addClass('fixed-header');}else{$('.header').removeClass('fixed-header');}});$(document).on('click','#loginSubmit',function(){$("#adminSignIn").submit();});});if(document.getElementById("myRange")!=null){var slider=document.getElementById("myRange");var output=document.getElementById("currencys");output.innerHTML=slider.value;slider.oninput=function(){output.innerHTML=this.value;}}
if(document.getElementById("myRange")!=null){document.getElementById("myRange").oninput=function(){var value=(this.value-this.min)/(this.max-this.min)*100
this.style.background='linear-gradient(to right, #1d5f44 0%, #1d5f44 '+value+'%, #c4c4c4 '+value+'%, #c4c4c4 100%)'};}
$(document).on("click",".logo-hide-btn",function(){$(this).parent().hide();});if($('.summernote').length>0){$('.summernote').summernote({height:200,minHeight:null,maxHeight:null,focus:false,toolbar:[['style',['bold','italic','underline','clear']],['font',['strikethrough','superscript','subscript']],['fontsize',['fontsize']],['color',['color']],['para',['ul','ol','paragraph']],['height',['height']]]});}
$(document).on("click",".addlinks",function(){var experiencecontent='<div class="form-group links-cont">'+
'<div class="row align-items-center">'+
'<div class="col-lg-3 col-12">'+
'<input type="text" class="form-control" placeholder="Label">'+
'</div>'+
'<div class="col-lg-8 col-12">'+
'<input type="text" class="form-control" placeholder="Link with http:// Or https://">'+
'</div>'+
'<div class="col-lg-1 col-12">'+
'<a href="#" class="btn btn-sm bg-danger-light  delete_review_comment">'+
'<i class="far fa-trash-alt "></i> '+
'</a>'+
'</div>'+
'</div>'+
'</div>';$(".settings-form").append(experiencecontent);return false;});$(".settings-form").on('click','.delete_review_comment',function(){$(this).closest('.links-cont').remove();return false;});$(document).on("click",".addnew",function(){var experiencecontent='<div class="form-group links-conts">'+
'<div class="row align-items-center">'+
'<div class="col-lg-3 col-12">'+
'<input type="text" class="form-control" placeholder="Label">'+
'</div>'+
'<div class="col-lg-8 col-12">'+
'<input type="text" class="form-control" placeholder="Link with http:// Or https://">'+
'</div>'+
'<div class="col-lg-1 col-12">'+
'<a href="#" class="btn btn-sm bg-danger-light  delete_review_comment">'+
'<i class="far fa-trash-alt "></i> '+
'</a>'+
'</div>'+
'</div>'+
'</div>';$(".settingset").append(experiencecontent);return false;});$(".settingset").on('click','.delete_review_comment',function(){$(this).closest('.links-conts').remove();return false;});$(document).on("click",".addlinknew",function(){var experiencecontent='<div class="form-group links-cont">'+
'<div class="row align-items-center">'+
'<div class="col-lg-3 col-12">'+
'<input type="text" class="form-control" placeholder="Label">'+
'</div>'+
'<div class="col-lg-8 col-12">'+
'<input type="text" class="form-control" placeholder="Link with http:// Or https://">'+
'</div>'+
'<div class="col-lg-1 col-12">'+
'<a href="#" class="btn btn-sm bg-danger-light  delete_review_comment">'+
'<i class="far fa-trash-alt "></i> '+
'</a>'+
'</div>'+
'</div>'+
'</div>';$(".settings-forms").append(experiencecontent);return false;});$(".settings-forms").on('click','.delete_review_comment',function(){$(this).closest('.links-cont').remove();return false;});$(document).on("click",".addsocail",function(){var experiencecontent='<div class="form-group countset">'+
'<div class="row align-items-center">'+
'<div class="col-lg-2 col-12">'+
'<div class="socail-links-set">'+
'<ul>'+
'<li class=" dropdown has-arrow main-drop">'+
'<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown" aria-expanded="false">'+
'<span class="user-img">'+
'<i class="fab fa-github me-2"></i>'+
'</span>'+
'</a>'+
'<div class="dropdown-menu">'+
'<a class="dropdown-item" href="#"><i class="fab fa-facebook-f me-2"></i>Facebook</a>'+
'<a class="dropdown-item" href="#"><i class="fab fa-twitter me-2"></i>twitter</a>'+
'<a class="dropdown-item" href="#"><i class="fab fa-youtube me-2"></i> Youtube</a>'+
'</div>'+
'</li>'+
'</ul>'+
'</div>'+
'</div>'+
'<div class="col-lg-9 col-12">'+
'<input type="text" class="form-control" placeholder="Link with http:// Or https://">'+
'</div>'+
'<div class="col-lg-1 col-12">'+
'<a href="#" class="btn btn-sm bg-danger-light  delete_review_comment">'+
'<i class="far fa-trash-alt "></i> '+
'</a>'+
'</div>'+
'</div> '+
'</div> ';$(".setings").append(experiencecontent);return false;});$(".setings").on('click','.delete_review_comment',function(){$(this).closest('.countset').remove();return false;});$(document).on("click",".addfaq",function(){var experiencecontent='<div class="row counts-list">'+
'<div class="col-md-11">'+
'<div class="cards">'+
'<div class="form-group">'+
'<label>Title</label>'+
'<input type="text" class="form-control" >'+
'</div>'+
'<div class="form-group mb-0">'+
'<label>Content</label>'+
'<textarea class="form-control"></textarea>'+
'</div>'+
'</div>'+
'</div>'+
'<div class="col-md-1">'+
'<a href="#" class="btn btn-sm bg-danger-light  delete_review_comment">'+
'<i class="far fa-trash-alt "></i> '+
'</a>'+
'</div>'+
'</div> ';$(".faq").append(experiencecontent);return false;});$(".faq").on('click','.delete_review_comment',function(){$(this).closest('.counts-list').remove();return false;});$(window).on("load",function(){document.onkeydown=function(e){if(e.keyCode==123){return false;}
if(e.ctrlKey&&e.shiftKey&&e.keyCode=='I'.charCodeAt(0)){return false;}
if(e.ctrlKey&&e.shiftKey&&e.keyCode=='J'.charCodeAt(0)){return false;}
if(e.ctrlKey&&e.keyCode=='U'.charCodeAt(0)){return false;}
if(e.ctrlKey&&e.shiftKey&&e.keyCode=='C'.charCodeAt(0)){return false;}};});document.oncontextmenu=function(){return false;};$(document).mousedown(function(e){if(e.button==2){return false;}
return true;});})(jQuery);