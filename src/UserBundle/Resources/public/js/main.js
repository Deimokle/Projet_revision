$(document).ready(function() {
    $('select').material_select();
});
$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 100, // Creates a dropdown of 100 years to control year
    max: true,
    format: 'dd/mm/yyyy'
});