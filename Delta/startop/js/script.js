export function deleteCookie(){
    document.cookie = "key= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
    window.location.href = "./index.php";
}
export function toPDF() {
    $.ajax({
        method: "POST",
        url: "../config/ConvertToPDF.php",
        data: { text: $("p.unbroken").text() }
    })
        .done(function( response ) {
            $("p.broken").html(response);
        });
}