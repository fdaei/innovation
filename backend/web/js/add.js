$('#AddDatepicker').on('click', add);
$('#RemoveDatepicker').on('click', remove);
function AddDatepicker() {
    var new_input = "<input data-jdp>";
    $('<input class="col-sm-12 form-control" data-jdp>').appendTo('#firoozeh');
}
function RemoveDatepicker() {
    var new_input = "<input data-jdp>";
    $('<input class="col-sm-12 form-control" data-jdp>').remove('#firoozeh');
}
function add() {
    var new_chq_no = parseInt($('#total_chq').val()) + 1;
    var new_input = "<input  class='col-sm-12 form-control' id='new_" + '1' + "data-jdp>";

    $('#new_chq').append(new_input);

    $('#total_chq').val(new_chq_no);
}

function remove() {
    var last_chq_no = $('#total_chq').val();

    if (last_chq_no > 1) {
        $('#new_' + last_chq_no).remove();
        $('#total_chq').val(last_chq_no - 1);
    }
}
$('#dropdown').change( function(){
    $.ajax({
        type: "POST",
        url: "activity/change",
        data: {'id' : event.target.id,'value': event.target.value },
        success: function (data) {
            alert(data);
        },
        error: function (errormessage) {

            //do something else
            alert("not working");

        }
    });
});
$('#button-collapse').click(function (){
    if ( document.getElementById("logo-expand").style.display=="block") {
        document.getElementById("logo-close").style.display = "block";
        document.getElementById("logo-expand").style.display = "none";
    }else{
        document.getElementById("logo-close").style.display = "none";
        document.getElementById("logo-expand").style.display = "block";
    }
});
// $(function() {
//     alert(document.getElementById("mapType").value());
//     if(document.getElementById("mapType").value == 1){
//         alert("ijju");
//         viewMap();
//     }else{
//         createMap();
//     }
// });
function createMap() {
    let config = {
        minZoom: 7,
        maxZoom: 18,
    };
    // magnification with which the map will start
    const zoom = 18;
    var lat=30.289358507458676;
    var lng=57.04063207695452;
    // co-ordinate
    const map = L.map("map", config).setView([lat, lng], zoom);
    var marker = L.marker([lat, lng]).addTo(map);
    map.on("click", function (e) {
            map.removeLayer(marker);
        const markerPlace = document.querySelector(".marker-position");
        marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map).bindPopup("Center Warsaw");
        document.getElementById("branches-latitude").value=e.latlng.lat;
        document.getElementById("branches-longitude").value= e.latlng.lng;
    });

    // Used to load and display tile layers on the map
    // Most tile servers require attribution, which you can set under `Layer`
    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);
}
function viewMap() {
    let config = {
        minZoom: 7,
        maxZoom: 18,
    };
    // magnification with which the map will start
    const zoom = 18;
    // co-ordinates
    const lat = document.getElementById("map-latitude").value;
    const lng = document.getElementById("map-longitude").value;
    const map = L.map("map", config).setView([lat, lng], zoom);
    var marker = L.marker([lat, lng]).addTo(map);
    // Used to load and display tile layers on the map
    // Most tile servers require attribution, which you can set under `Layer`
    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);
}
