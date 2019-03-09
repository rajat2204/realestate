    // Select 2
/*setTimeout(function(){
    var $select2 = $('.selectType').select2({
        minimumResultsForSearch: Infinity
    }).parent('.customSelect').addClass('select2Init'); 
},500);*/

$(document).on('click', '[data-request="remove"]', function(){
    var $this = $(this);
    var $target = $this.attr('data-target');
    $($target).hide('slow', function(){ $($target).remove(); });
});

$(document).on('click','[data-request="ajax-submit"]',function(){
    /*REMOVING PREVIOUS ALERT AND ERROR CLASS*/
    $('#cover').show();  
    $('.alert').remove(); 
    $(".has-error").removeClass('has-error');
    $('.help-block').remove();
    if($('#description').attr('name')!=undefined){
        $( "#description" ).val(CKEDITOR.instances.description.getData());
    }
    if($('#reach').attr('name')!=undefined){
        $( "#reach" ).val(CKEDITOR.instances.reach.getData());
    }
    if($('#purchase').attr('name')!=undefined){
        $( "#purchase" ).val(CKEDITOR.instances.purchase.getData());
    }
    if($('#key_points').attr('name')!=undefined){
        $( "#key_points" ).val(CKEDITOR.instances.key_points.getData());
    }
    if($('#remarks').attr('name')!=undefined){
        $( "#remarks" ).val(CKEDITOR.instances.remarks.getData());
    }
    var $this       = $(this);
    var $target     = $this.data('target');
    var $url        = $($target).attr('action');
    var $method     = $($target).attr('method');
    var $modal      = $this.data('modal');
    var $data       = new FormData($($target)[0]);
    if(!$method){ $method = 'get'; }
    $.ajax({
        url: $url, 
        data: $data,
        cache: false, 
        type: $method, 
        dataType: 'json',
        contentType: false, 
        processData: false,
        success: function($response){
            if ($response.status === true) {
                if($response.redirect){ 
                    if($response.modal){
                        $($target).trigger('reset');
                        $($modal).attr('data-success',$response.redirect);
                        swal({
                            html: $response.message,
                            showLoaderOnConfirm: false,
                            showCancelButton: false,
                            showCloseButton: true,
                            showConfirmButton: true,
                            allowEscapeKey: false,
                            allowOutsideClick:false,
                            imageUrl :  $response.successimage,
                            imageClass: 'success-image-popup',
                            customClass: 'success-popup-custom-class',
                            confirmButtonText: 'Ok'
                        }).then(function(isConfirm){
                            if(isConfirm){
                                if($response.redirect != true){
                                    setTimeout(function(){
                                        window.location.href = $response.redirect;
                                    },1000);
                                }
                            }
                        },function (dismiss){}).catch(swal.noop);
                        
                        // if($response.redirect !=true){
                        //     setTimeout(function(){
                        //         window.location.href = $response.redirect;
                        //     },1000);
                        // }
                    }else{
                        if($response.redirect != true){
                            window.location.href=$response.redirect;
                        }
                    }
                }
            }else{
                if($response.message.length > 0 && $response.message !== 'M0000'){
                    $('.messages').html($response.message);
                }

                if (Object.size($response.data) > 0) {
                    /*TO DISPLAY FORM ERROR USING .has-error class*/
                    if(typeof grecaptcha != 'undefined'){
                        grecaptcha.reset();
                    }
                    // onloadCallback();
                    show_validation_error($response.data);
                }
            }
            $('#cover').hide();
        }
    }); 
});

$(document).on('click','[data-request="ajax-confirm"]',function(){
    $('.alert').remove(); $(".has-error").removeClass('has-error');$('.error-message').remove();

    var $this       = $(this);
    var $url        = $this.data('url');
    var $ask        = $this.data('ask');
    var $askImage  = $this.data('ask_image');

    swal({
        html: $ask,
        showLoaderOnConfirm: true, 
        showCancelButton: true, 
        showCloseButton: true, 
        allowEscapeKey: false, 
        allowOutsideClick:false, 
        imageUrl :  $askImage,
        imageClass: 'ask-image-popup',        
        confirmButtonText: "YES, SURE", 
        cancelButtonText: 'NOT NOW', 
        confirmButtonColor: '#0FA1A8', 
        cancelButtonColor: '#CFCFCF',
        preConfirm: function (res) {
            return new Promise(function (resolve, reject) {
                if (res === true) {
                    $.ajax({
                        method: "POST",
                        url: $url,
                    })
                    .done(function($response) {
                        if($response.status == true){
                            if(typeof LaravelDataTables !== 'undefined'){
                                LaravelDataTables["dataTableBuilder"].draw();
                            }

                            if($response.message){
                                // $('.content').prepend($response.message);
                                
                                if($('.alert').length > 0){
                                    $('html, body').animate({
                                        scrollTop: ($('.alert').offset().top-100)
                                    }, 200);
                                }
                            }

                            if($response.redirect != true){
                               window.location.href = $response.redirect;
                            }else if($response.redirect === true){
                                location.reload();
                            }else if($($response.redirect).length > 0){
                                $($response.redirect).remove();
                            }

                            resolve();              
                        }
                    });
                }
            })
        }
    }).then(function(isConfirm){},function (dismiss){}).catch(swal.noop);
});

$(document).on('click','[data-request="add-another"]',function(){
    $('#popup').show();  $('.alert').remove(); $(".has-error").removeClass('has-error');$('.error-message').remove();   
    var $formData       = new FormData();
    var $this           = $(this);
    var $target         = $this.data('target');
    var $url            = $this.data('url');
    var $count          = parseInt($this.attr('data-count'));

    $formData.append('count',$count);
    $.ajax({
        url:$url,
        type:'POST',
        data:$formData,
        dataType:'JSON',
        processData:false,
        contentType:false,
        success:function($response){
            if($response.status == true){
                $this.attr('data-count',$count+1);
                $($response.data).hide().appendTo($target).fadeIn(1000);
                $('#popup').hide();
            }else{
                show_validation_error($response.data);
                $('#popup').hide();
            }
        }
    });
});

$(document).on('keypress keyup','[data-request="isnumeric"]', function(event){
    if(event.which == 8){

    } else if((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});


function readURL(input,$attribute) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $($attribute).attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

/*var selectStyle = function(){
    var $select2 = $('.selectType').select2({
        minimumResultsForSearch: Infinity
    }).parent('.customSelect').addClass('select2Init'); 
}*/
var dynamicDatepicker = function($className, $maxDate=true,$minDate=true){
    $($className).datepicker({
        showOn: "button",
        buttonImage: asset_url+"images/calender.png",
        buttonImageOnly: true,
        dateFormat:'d M , yy',
        changeMonth: true, 
        changeYear: true,     
        buttonText:"Choose Date Of Birth",
        maxDate: $maxDate == true ? new Date() : '',
        minDate: $minDate == true ? 0 : '',
        yearRange:"c-100:c+100"
    },
    function(start) {
        $('.hashowCalender input[type="text"]').val(start.format('DD/MM/YYYY'));
    }); 
}

var dynamicSelect2 = function($className, $url,$placeholder,$tags){
    if($placeholder){
        $placeholder = 'Select';
    }

    if($tags){
        $tags = true;
    }

    $($className).select2({
        formatLoadMore   : function() {return 'Loading more...'},
        allowClear : true,
        ajax: {
            url: $url,
            dataType: 'json',
            data: function (params) {
                var query = {
                    search: params.term,
                    type: 'public'
                }
                return query;
            }
        },placeholder:$placeholder
    });
}

function show_validation_error(msg) {
    if ($.isPlainObject(msg)) {
        $data = msg;
    }else {
        $data = $.parseJSON(msg);
    }
    
    $.each($data, function (index, value) {
        var name    = index.replace(/\./g, '][');
        
        if (index.indexOf('.') !== -1) {
            name = name + ']';
            name = name.replace(']', '');
        }
        if (name.indexOf('[]') !== -1) {
            $('form [name="' + name + '"]').last().closest('').addClass('has-error');
            $('form [name="' + name + '"]').last().closest('.form-group').find('').append('<span class="help-block">'+ value +'</span>');
        }else if($('form [name="' + name + '[]"]').length > 0){
            $('form [name="' + name + '[]"]').closest('.form-group').addClass('has-error');
            $('form [name="' + name + '[]"]').parent().after('<span class="help-block">'+ value +'</span>');
        }else{
            if($('form [name="' + name + '"]').attr('type') == 'checkbox' || $('form [name="' + name + '"]').attr('type') == 'radio'){
                if($('form [name="' + name + '"]').attr('type') == 'checkbox'){
                    $('form [name="' + name + '"]').closest('.form-group').addClass('has-error');
                    $('form [name="' + name + '"]').parent().after('<span class="help-block">'+ value +'</span>');
                }else{
                    $('form [name="' + name + '"]').closest('.form-group').addClass('has-error');
                    $('form [name="' + name + '"]').parent().parent().append('<span class="help-block">'+ value +'</span>');
                }
            }else if($('form [name="' + name + '"]').get(0)){
                
                if($('form [name="' + name + '"]').get(0).tagName == 'SELECT'){
                    
                    $('form [name="' + name + '"]').closest('.form-group').addClass('has-error');
                    $('form [name="' + name + '"]').parent().after('<span class="help-block">'+ value +'</span>');
                }else if($('form [name="' + name + '"]').attr('type') == 'password' && $('form [name="' + name + '"]').hasClass('hideShowPassword-field')){
                    $('form [name="' + name + '"]').closest('.form-group').addClass('has-error');
                    $('form [name="' + name + '"]').parent().after('<span class="help-block">'+ value +'</span>');
                }else{
                    $('form [name="' + name + '"]').closest('.form-group').addClass('has-error');
                    $('form [name="' + name + '"]').after('<span class="help-block">'+ value +'</span>');
                }
            }else{
                $('form [name="' + name + '"]').closest('.form-group').addClass('has-error');
                $('form [name="' + name + '"]').after('<span class="help-block">'+ value +'</span>');
            }
        }

        // $('.error-message').html($('.error-message').text().replace(".,",". "));
    });

    /*SCROLLING TO THE INPUT BOX*/
    scroll();
}

function scroll() {
    if ($(".help-block").not('.modal .help-block').length > 0) {
        $('html, body').animate({
            scrollTop: ($(".help-block").offset().top - 100)
        }, 200);
    }
}

function strip_html_tags(str){
    if ((str===null) || (str==='')){
        return false;
    }else{
        str = str.toString();
    }
    return str.replace(/<[^>]*>/g, '');
}

Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};




// admin panel js
$('.navbar-custom.navbar-fixed-top .navbar-toggle').on('click', function(){
  $('#sidebar-collapse').slideToggle('slow');
});