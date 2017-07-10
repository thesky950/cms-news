function touchspin () {
	$(".touchspin-basic").TouchSpin({
	    postfix: '<i class="icon-paragraph-justify2"></i>'
	});	
}

function switchBootstrap () {
	$(".switch").bootstrapSwitch();
}

function tags_keywords () {
    $('.tags-input').tagsinput();
}

function tags_descriptions () {
	$('.maxlength-textarea').maxlength({
        alwaysShow: true
    });
}

function alertHide () {
    $(".alert-success,.alert-danger").delay(3000).slideUp(1000);
}

function checkCategory () {
    $('input[type=checkbox]').click(function () {
        $(this).parent().find('li input[type=checkbox]').prop('checked', $(this).is(':checked'));
        var sibs = false;
        $(this).closest('ul').children('li').each(function () {
            if($('input[type=checkbox]', this).is(':checked')) sibs=true;
        })
        $(this).parents('ul').prev().prop('checked', sibs);
    });
}

function warning_alert () {
    $('.sweet_warning').on('click', function(event) {
        event.preventDefault();
        var linkDelete = $(this).attr("href");
        swal({
          title: "Are you sure delete it?",
          text: "You will not be able to recover this data !",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it !",
          closeOnConfirm: false
        },
        function(isConfirm){
            if (isConfirm) {
                window.location.href = linkDelete;
            } else {
                return false;
            }
        });
    });
}

function tableHighlight () {
    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        /*columnDefs: [{ 
            orderable: false,
            width: '100px',
            targets: [ 5 ]
        }],*/
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

    // Highlighting rows and columns on mouseover
    var lastIdx = null;
    var table = $('.datatable-highlight').DataTable();
     
    $('.datatable-highlight tbody').on('mouseover', 'td', function() {
        var colIdx = table.cell(this).index().column;

        if (colIdx !== lastIdx) {
            $(table.cells().nodes()).removeClass('active');
            $(table.column(colIdx).nodes()).addClass('active');
        }
    }).on('mouseleave', function() {
        $(table.cells().nodes()).removeClass('active');
    });

    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');
    
    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
}

function generate_pass () {
    // Input labels
    var $inputLabel = $('.label-indicator input');
    var $inputLabelAbsolute = $('.label-indicator-absolute input');
    var $inputGroup = $('.group-indicator input');

    // Output labels
    var $outputLabel = $('.label-indicator > span');
    var $outputLabelAbsolute = $('.label-indicator-absolute > span');
    var $outputGroup = $('.group-indicator > span');

    // Min input length
    $.passy.requirements.length.min = 4;

    // Strength meter
    var feedback = [
        {color: '#D55757', text: 'Weak', textColor: '#fff'},
        {color: '#EB7F5E', text: 'Normal', textColor: '#fff'},
        {color: '#3BA4CE', text: 'Good', textColor: '#fff'},
        {color: '#40B381', text: 'Strong', textColor: '#fff'}
    ];

    // Label indicator
    $inputLabel.passy(function(strength) {
        $outputLabel.text(feedback[strength].text);
        $outputLabel.css('background-color', feedback[strength].color).css('color', feedback[strength].textColor);
    });

    // Label
    $('.generate-label').click(function() {
        $inputLabel.passy( 'generate', 15 );
    });
}

/********************* Convert To Slug *********************/
function convertToSlug () {
	$('#name-slug-vi').keyup(function() {
        var val = $(this).val();
        var slug = to_slug(val);
        $("#txtSlugVi").val(slug)
    });

    $('#name-slug-en').keyup(function() {
        var val = $(this).val();
        var slug = to_slug(val);
        $("#txtSlugEn").val(slug)
    });
}

function to_slug(str) {
    str = str.toLowerCase();     
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');
    str = str.replace(/([^0-9a-z-\s])/g, '');
    str = str.replace(/(\s+)/g, '-');
    str = str.replace(/^-+/g, '');
    str = str.replace(/-+$/g, '');
    return str;
}
/********************* End *********************/

$(document).ready(function() {
	touchspin ();

	switchBootstrap ();

	convertToSlug ();

	tags_keywords ();

	tags_descriptions ();

	alertHide ();

    warning_alert ();

    checkCategory ();

    tableHighlight ();

    generate_pass ();
	
	switchAction ();
	
	selectPosition ();
	
	updatePosition ();
});

/********************* CKFinder Upload File *********************/
$(document).ready(function() {
    $(document).on('click', '.upload-image', function(event) {
        var eleImg = $(this).attr('id');
        var elmInput = $(this).next().attr('id')
        selectFileWithCKFinder('#'+eleImg,'#'+elmInput);
        event.preventDefault();
    });
    $("#main-image").click(function(event) {
        var eleImg = $(this).attr('id');
        var elmInput = $(this).next().attr('id');
        selectFileWithCKFinder('#'+eleImg,'#'+elmInput);
        event.preventDefault();
    });

    $("#txtSource").click(function(event) {
        var elmInput = $(this).attr('id');
        selectSourceCode('#'+elmInput);
    });
});

function updateImage (eleImg,elmInput,val) {
    $(eleImg).attr('src',val);
    $(elmInput).val(val);
}

function updateInput (elmInput,val) {
    $(elmInput).val(val);
}

function selectFileWithCKFinder( elmImg , elmInput ) {
    CKFinder.popup( {
        chooseFiles: true,
        width: 1000,
        height: 600,
        onInit: function( finder ) {
            finder.on( 'files:choose', function( evt ) {
                var file = evt.data.files.first();
                updateImage(elmImg,elmInput,file.getUrl());
            });
        }
    } );
}

function selectSourceCode ( elmInput ) {
    CKFinder.popup( {
        chooseFiles: true,
        width: 1000,
        height: 600,
        onInit: function( finder ) {
            finder.on( 'files:choose', function( evt ) {
                var file = evt.data.files.first();
                updateInput (elmInput,file.getUrl());
            });
        }
    } );
}

function switchAction () {
    $('input[class="switch"]').on('switchChange.bootstrapSwitch', function (event, data) {
       var id = $(this).attr("data-id");
       var table = $(this).attr("data-table");
       var col = $(this).attr("data-col"); 
       $.ajax({
           url: 'ajax/index.php?p=switch',
           type: 'GET',
           data: {state : data , table : table , col : col , id : id},
           dataType: 'html',
           success : function (data) {
                console.log(data);
           }
       });
    });
}

function selectPosition () {
    $("select[name='sltParent']").change(function() {
        var id = $(this).val();
        $.ajax({
            url: 'ajax/index.php?p=position',
            type: 'GET',
            dataType: 'html',
            data: {id: id},
            success:function (position) {
                $("input[name='txtPosition']").val(position);
            }
        });
    });
}

function updatePosition () {
    $("input[name='txtPosition']").change(function() {
        var id  = $(this).attr('data-id');
        var pos = $(this).val();
        $.ajax({
            url: 'ajax/index.php?p=update_position',
            type: 'GET',
            dataType: 'html',
            data: {id : id , pos : pos},
            success:function (data) {
                if (data == "Success") {
                    location.reload();
                }
            }
        })
    });
}
/********************* End *********************/
