$("#btn-export").click(function() {
    var url = $("#export-url").val();

    url += `?`;
    if($("#date-from").val() != "") {
        url += `date_from=${$("#date-from").val()}&`;
    }
    if($("#date-to").val() != "") {
        url += `date_to=${$("#date-to").val()}&`;
    }
    url = url.slice(0, url.length - 1);

    open(url, '_blank')
});