$(document).ready(function () {
  $("#result").html("");
  $.ajax({
    url: "fetch_all_table.php",
    method: "post",
    dataType: "text",
    success: function (data) {
      $("#result").html(data);
    },
  });
  $("#search_text").keyup(function () {
    var txt = $(this).val();
    if (txt != "") {
      $("#result").html("");
      $.ajax({
        url: "fetch_table.php",
        method: "post",
        data: { search: txt },
        dataType: "text",
        success: function (data) {
          $("#result").html(data);
        },
      });
    } else {
      $("#result").html();
      $.ajax({
        url: "fetch_all_table.php",
        method: "post",
        data: { search: txt },
        dataType: "text",
        success: function (data) {
          $("#result").html(data);
        },
      });
    }
  });
});

$(document).ready(function () {
  $("#result2").html(
    '<div class="card-container"> กรอกชื่อหรือชื่อผู้ใช้เพื่อนค้นหา </div>'
  );
  $("#search_text").keyup(function () {
    var txt = $(this).val();
    if (txt != "") {
      $("#result2").html("");
      $.ajax({
        url: "fetch_mobile.php",
        method: "post",
        data: { search: txt },
        dataType: "text",
        success: function (data) {
          $("#result2").html(data);
        },
      });
    } else {
      $("#result2").html(
        '<div class="card-container"> กรอกชื่อหรือชื่อผู้ใช้เพื่อค้นหา </div>'
      );
    }
  });
});
