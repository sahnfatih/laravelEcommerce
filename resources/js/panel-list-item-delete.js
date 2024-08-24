$(document).ready(function() {
    $("a.list-item-delete").on("click", function(e) {
        e.preventDefault();

        let url = $(this).attr("href");

        if (url !== null) {
            let confirmation = confirm("Silmek istiyor musun?");
            if (confirmation) {
                axios.delete(url, {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // CSRF token ekliyoruz
                    }
                }).then(result => {
                    console.log(result.data);
                    $("#" + result.data.id).remove();  // Elementi kaldır
                    // window.location.reload();  // Sayfayı yenile (isteğe bağlı)
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    });
});

