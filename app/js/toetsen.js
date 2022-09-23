$.ajax({
    type:       "GET",
    url:        "../app/php/get.toetsen.php",
    dataType:   "html",
    success: function (table) {
        $(".toetsen").append(table);
    },
    error: function (request, error) {
        console.log ("FOUT:" + error);
    }
}); 