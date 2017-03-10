/**
 * Created by daemonvirus on 12/19/16.
 */

/**
 * The list of global variable to be used by the javascript functions
 * @type {number}
 */
var activity_name;
var success_indicator;
var target_indicator;
var baseline_indicator;
var staff_responsible;
var percentage_achieved;
var source_funding;
var item_description;
var first_quarter = 0;
var second_quarter = 0;
var third_quarter = 0;
var fourth_quarter = 0;
var quantity_value      = 0;
var price_per_unit      = 0;
var total_cost          = 0;

var strategyId = 0;
var objectiveId = 0;
var strategicId= 0;
var strategy = null;
var strategic_direction = null;
// var departmentId = 0;


$('ul li').on('click', function () {

    $('ul li.active').removeClass('active');
    $(this).addClass('active');
});


/**
 * The jquery method below is responsible for getting
 * displaying a modal for adding objectives to
 * strategic directions by HOD
 */
$('.add-objective').on('click', function (event) {
    // console.log(strategy);
    event.preventDefault();
    var strategy = event.target.parentNode.parentNode.dataset['strategy'];
    strategyId = event.target.parentNode.parentNode.dataset['strategyid'];
    $('#strategy').val(strategy);
    $('#add-obj-modal').modal();
});

/**
 * the below method is used to save an object to the database
 * when the the user clicks the save button after entering the data in the
 * the object area
 */
$('#modal-save').on('click',function () {

    var data =  $('#modal-objective').val();
    console.log(strategyId , data);
    $.ajax({
        method: "POST",
        url: urlSaveObjective,
        data: { body:  data, strategyId: strategyId, _token: token }
    })
        .done(function (message) {
            console.log(message['success']);
            $('#add-obj-modal').modal('hide');
        })
});

/**
 * The opens a modal for adding an activity to the
 * selected activity
 */
$('.add-activity').on('click', function (event) {

    event.preventDefault();
    strategic_direction = event.target.parentNode.parentNode.dataset['strategicdirection'];
    var objective_info  = event.target.parentNode.parentNode.dataset['objectivebody'];
    objectiveId = event.target.parentNode.parentNode.dataset['objectiveid'];
    strategicId = event.target.parentNode.parentNode.dataset['strategicid'];
    // console.log(objectiveId, strategicId, objective_info);
    $('#strategy').val(strategic_direction);
    $('#objective').val(objective_info);

    $('#activity-modal').modal();
});

/**
 * The function below is used for saving an activity
 * entered with regard to the objective chosen
 */
$('#save-activity').on('click', function (event) {
    event.preventDefault();

        // // It has the name attribute "registration"
        // $("#addActivities").validate({
        //     // Specify validation rules
        //     rules: {
        //         // The key name on the left side is the name attribute
        //         // of an input field. Validation rules are defined
        //         // on the right side
        //         activityName: "required",
        //         successIndicator: "required",
        //         targetOfIndicator: "required",
        //         baselineOfIndicator: "required",
        //         staffResponsible: "required",
        //         percentageAchieved: "required",
        //         sourceOfFunding: "required",
        //         ItemDescription: "required",
        //         quantity: "required",
        //         pricePerUnit: "required",
        //         cost: "required",
        //     },
        //     // Specify validation error messages
        //     messages: {
        //         activityName: "Please enter your activity name",
        //         successIndicator: "Please enter your  success indicator",
        //     },
        //     // Make sure the form is submitted to the destination defined
        //     // in the "action" attribute of the form when valid
        //     // submitHandler: function(form) {
        //     //     form.submit();
        //     // }
        // });
    activity_name       = $('#activityName').val();
    success_indicator   = $('#successIndicator').val();
    target_indicator    = $('#targetOfIndicator').val();
    baseline_indicator  = $('#baselineOfIndicator').val();
    staff_responsible   = $('#staffResponsible').val();
    percentage_achieved = $('#percentageAchieved').val();
    source_funding      = $('#sourceOfFunding').val();
    item_description    = $('#ItemDescription').val();
    quantity_value      = $('#quantity').val();
    price_per_unit      = $('#pricePerUnit').val();
    total_cost          = $('#cost').val();
    if ($('#firstQuarter').is(':checked')) { first_quarter = 1; }
    if ($('#secondQuarter').is(':checked')) { second_quarter = 1; }
    if ($('#thirdQuarter').is(':checked')) { third_quarter = 1; }
    if ($('#fourthQuarter').is(':checked')) { fourth_quarter = 1; }

    $.ajax({
        method: "POST",
        url   :urlPostActivity,
        data  : {
            objectiveId: objectiveId,
            strategicId: strategicId,
            activity_name: activity_name,
            success_indicator:  success_indicator,
            target_indicator:  target_indicator,
            baseline_indicator:  baseline_indicator,
            staff_responsible:  staff_responsible,
            percentage_achieved:   percentage_achieved,
            source_funding: source_funding,
            item_description: item_description,
            quantity_value: quantity_value,
            price_per_unit: price_per_unit,
            total_cost:  total_cost,
            first_quarter:  first_quarter,
            second_quarter:  second_quarter,
            third_quarter:  third_quarter,
            fourth_quarter:  fourth_quarter,
            _token : token
        }
    })
        .done(function (msg) {
            console.log(msg);
        });

    $('#activity-modal').modal('hide');

    $('.modal').on('hidden.bs.modal', function() {

        $(this).find("input,textarea").val('');
        $('#firstQuarter').prop('checked', false);
        first_quarter = 0;
        $('#secondQuarter').prop('checked', false );
        second_quarter = 0;
        $('#thirdQuarter').prop('checked', false);
        third_quarter =0;
        $('#fourthQuarter').prop('checked', false);
        fourth_quarter =0;
    });
});

/**
 * The jquery method is responsible for getting
 * the department-id for the department the
 * user selects form the drop down menu
 */
// $('#department').on('change', function (e){
//     e.preventDefault();
//     departmentId = $('#department').val(); //get the department id
//     $.ajax({
//         method: "POST",
//         url : UrlForDepartmentId,
//         data: { departmentId: departmentId, _token: token }
//     })
//         .done(function (data) {
//
//             $('#name').text(data);
//             console.log('success');
//             console.log(data);
//             //var data = $.parseJSON(data);
//             if(data.success == true) {
//                 //user_jobs div defined on page
//                 $('#table').html(data.html);
//             } else {
//                 $('#table').html(data.html + '{{ $user->username }}');
//             }
//         });
// });