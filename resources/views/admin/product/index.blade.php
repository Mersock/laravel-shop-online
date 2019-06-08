@extends('layouts.admin.main')

@section('content-admin')
@include('admin.product.create')
@include('admin.product.update')
    {{-- hidden ของ pagination --}}
    <input type="hidden" id="page" name="page" value="">

        <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                    สินค้า
                    <button type="button" class="btn btn-info btn-sm float-right" id="read-data">รีโหลดข้อมูล</button>
                  </div>
                  <div class="card-body">  
                    @include('admin.product.productPage')
                  </div>
                </div>

          </div>
        </div>   
@endsection

@section('script-admin')
<script>

    $('.price').on('keydown', '.price_number', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});


$('#read-data').on('click',function(){
  readPage(1);
  // var read_data = '/admin/product/page/pagination?page=1';
  //var read_data = "{{route('product.read-data')}}";
    // $.get(read_data,function(data){
      //empty ป้องกันกดแล้วข้อมูลมาซ้ำ
      // console.log(data);
      // $("#data-table").empty().html(data);
      //   location.hash=1;
      //   $("#page").val(1);
        // $.each(data,function(index,value){
        //   var tr = $("<tr>");
        //     tr.append($("<td>",{
        //       text:count_row,
        //     })).append($("<td>",{
        //       text:value.name
        //     })).append($("<td>",{
        //       text:value.description
        //     })).append($("<td>",{
        //       text:value.size
        //     })).append($("<td>",{
        //       text:value.image
        //     })).append($("<td>",{
        //       text:value.category_id
        //     })).append($("<td>",{
        //       html:"<a href='#'>View</a> "+" <a href='#'>Edit</a> "+" <a href='#'>Delete</a> "
        //     }))
        //     $("#product_list").append(tr);
        //     count_row++;
        // });
    // });
});
//เพิ่ม
$("#form-insert").on("submit",function(e){
      e.preventDefault();
      //var data = $(this).serialize();
      var data = new FormData($(this)[0]);
      var url =  $(this).attr("action");
      var post = $(this).attr("method");
      $.ajax({
        type: post,
        url:url,
        data:data,
        cache: false,
        contentType: false,
        processData: false,
        success:function(data){
          // console.log(data);
          //บันทึกได้
          if(data.status=='success'){

            $("#form-insert input:text,select, textarea").each(function(){
                var check_val = $(this)
                if(check_val.val()!=""){
                  check_val.removeClass('is-invalid');
                }
              });

            $("#add_data").modal("hide");

            //ลำดับที่ในการเพิ่มข้อมูล
            var rows = $("#product_list tr:last-child  td:first-child").text();
            // console.log(rows);
            var nums_rows = parseInt(rows) || 0;
            nums_rows++;
            //url path file
            var getUrl = window.location;
            var baseUrl = getUrl.protocol + "//" + getUrl.host + "/";

            var call_active = "";
              if(data.products.active==1){
                call_active = "ใช้งาน";
              }else{
                call_active = "ไม่ใช้งาน";
              }

            var html="";
            html += "<tr id='"+data.products.id+"'>";
            html += "<td class='text-center'>"+nums_rows+"</td>";
            html +="<td>"+data.products.name+"</td>";
            html +="<td>"+data.products.description+"</td>";
            html +="<td>"+data.products.size+"</td>";
            html +="<td>"+data.products.price+"</td>";
            if(data.products.image!=""){
              html +="<td class='text-center'><img src='"+baseUrl+"images/product_image/"+data.products.image+"' class='img-thumbnail' width='50px' height='50px'></td>";
            }else{
              html +="<td></td>";
            }
            html +="<td>"+data.products.catgory_name+"</td>";
            html +="<td>"+call_active+"</td>";
            html +="<td nowrap><button class='btn btn-warning btn-sm' id='edit' data-id='"+data.products.id+"'><i class='fas fa-edit'></i>&nbsp;แก้ไข</button>"
                  +"&nbsp;<button class='btn btn-danger btn-sm' id='delete' data-id='"+data.products.id+"'><i class='fas fa-trash-alt'></i>&nbsp;ลบ</button></td>";
            html += "</tr>";

            $("#not_found").remove();  
            $("#product_list").append(html);
            // var tr = $('<tr>',{
            //   id:data.products.id
            // });
            // tr.append($("<td>",{
            //   text:nums_rows,
            // })).append($("<td>",{
            //   text:data.products.name
            // })).append($("<td>",{
            //   text:data.products.description
            // })).append($("<td>",{
            //   text:data.products.size
            // })).append($("<td>",{
            //   text:data.products.image
            // })).append($("<td>",{
            //   text:data.products.category_id
            // })).append($("<td>",{
            //   html:"&nbsp;&nbsp;<a href='javascript:void(0)' class='btn btn-primary btn-sm' id='view' data-id='"+data.products.id+"'><i class='fas fa-window-maximize'></i>&nbsp;View</a>"
            //       +"&nbsp;&nbsp;<a href='javascript:void(0)' class='btn btn-warning btn-sm' id='edit' data-id='"+data.products.id+"'><i class='fas fa-edit'></i>&nbsp;Edit</a>"
            //       +"&nbsp;&nbsp;<a href='javascript:void(0)' class='btn btn-danger btn-sm' id='delete' data-id='"+data.products.id+"'><i class='fas fa-trash-alt'></i>&nbsp;Delete</a>&nbsp;"
            // }));
          //บันทึกไม่ได้
          }else{
            //show_error
            // if(data.error.length>0){
            //   show_msg_error(data.error);
            // }

            //Focus input ตัวแรก
            var invalid_focus = data.error[0].split(" ")[1];
            $("#form-insert #"+invalid_focus).focus();

            $.each(data.error,function(index,value){
              //split required ที่ส่งมาจาก controller
              var valid = data.error[index].split(" ")[1];
                  $('#form-insert #'+valid).addClass('is-invalid');
            });
            $("#form-insert input:text,select, textarea").each(function(){
                var check_val = $(this)
                if(check_val.val()!=""){
                  check_val.removeClass('is-invalid');
                }
              });
          }
        }
      });
});
//เพิ่ม

//ลบ
$('body').delegate('#product_list #delete','click',function(e){
    var id = $(this).attr('data-id');
    // console.log(id);
    $.post("{{route('product.destroy')}}",{id:id},function(data){    
        $("tr#"+id).remove();
        var page = $('#page').val();
        readPage(page);
    });
});
//ลบ

//แก้ไข
$('body').delegate('#product_list #edit','click',function(e){
    var id = $(this).attr('data-id');
    $.get("{{route('product.edit')}}",{id:id},function(data){
        // console.log(data);
        $("#form-update").find("#id").val(data.id);
        $("#form-update").find("#name").val(data.name);
        $("#form-update").find("#description").val(data.description);
        $("#form-update").find("#size").val(data.size);
        $("#form-update").find("#price").val(data.price);
        $("#form-update").find("#category").val(data.category_id);
      //$("#form-update").find("#image").val(data.image);
      if(data.active==1){
        $("#active_1").prop("checked",true);
      }else{
        $("#active_0").prop("checked",true);
      }
        $("#update_data").modal("show");
    });  
});

$("#form-update").on("submit",function(e){
  e.preventDefault();
  var url = $(this).attr('action');
  //var data = $(this).serialize();
  var post = $(this).attr("method");
  var data = new FormData($(this)[0]);
  $.ajax({
    type: post,
    url:url,
    data:data,
    cache: false,
    contentType: false,
    processData: false,
    success:function(data){

    if(data.status=='success'){
      // console.log(data);

      $("#update_data").modal("hide");
      $("#form-update").trigger('reset');
          //หาลำดับที่ใน row นั้นๆ
          var rows = $("#product_list tr#"+data.products.id).find('td:eq(0)').text();

          var check_row_product ="";
          if(data.count_product>0){
            check_row_product = "disabled";
          }

          //url path file
          var getUrl = window.location;
          var baseUrl = getUrl.protocol + "//" + getUrl.host + "/";

          var call_active = "";
            if(data.products.active==1){
              call_active = "ใช้งาน";
            }else{
            call_active = "ไม่ใช้งาน";
            }
          
          var html ="";

          html += "<tr id='"+data.products.id+"'>";
          html += "<td class='text-center'>"+rows+"</td>";
          html +="<td>"+data.products.name+"</td>";
          html +="<td>"+data.products.description+"</td>";
          html +="<td>"+data.products.size+"</td>";
          html +="<td>"+data.products.price+"</td>";
          if(data.products.image!=""){
              html +="<td class='text-center'><img src='"+baseUrl+"images/product_image/"+data.products.image+"' class='img-thumbnail' width='50px' height='50px'></td>";
            }else{
              html +="<td></td>";
          }
          html +="<td>"+data.products.catgory_name+"</td>";
          html +="<td>"+call_active+"</td>";
          html +="<td nowrap><button class='btn btn-warning btn-sm' id='edit' data-id='"+data.products.id+"'><i class='fas fa-edit'></i>&nbsp;แก้ไข</button>"
                 +"&nbsp;<button class='btn btn-danger btn-sm' "+check_row_product+" id='delete' data-id='"+data.products.id+"'><i class='fas fa-trash-alt'></i>&nbsp;ลบ</button></td>";
          html += "</tr>";

          // var tr = $('<tr>',{
          //   id:data.products.id
          // });
          // tr.append($("<td>",{
          //   text:rows
          // })).append($("<td>",{
          //   text:data.products.name
          // })).append($("<td>",{
          //   text:data.products.description
          // })).append($("<td>",{
          //   text:data.products.size
          // })).append($("<td>",{
          //   text:data.products.image
          // })).append($("<td>",{
          //   text:data.products.category_id
          // })).append($("<td>",{
          //   html:"&nbsp;&nbsp;<a href='javascript:void(0)' class='btn btn-primary btn-sm' id='view' data-id='"+data.products.id+"'><i class='fas fa-window-maximize'></i>&nbsp;View</a>"
          //        +"&nbsp;&nbsp;<a href='javascript:void(0)' class='btn btn-warning btn-sm' id='edit' data-id='"+data.products.id+"'><i class='fas fa-edit'></i>&nbsp;Edit</a>"
          //        +"&nbsp;&nbsp;<a href='javascript:void(0)' class='btn btn-danger btn-sm' id='delete' data-id='"+data.products.id+"'><i class='fas fa-trash-alt'></i>&nbsp;Delete</a>&nbsp;"
                 
          // }))
          $("#product_list tr#"+data.products.id).replaceWith(html);

    }else{
            //Focus input ตัวแรก
            var invalid_focus = data.error[0].split(" ")[1];
            $("#form-update #"+invalid_focus).focus();

            $.each(data.error,function(index,value){
              //split required ที่ส่งมาจาก controller
              var valid = data.error[index].split(" ")[1];
                  $('#form-update #'+valid).addClass('is-invalid');
            });
            $("#form-update input:text,select, textarea").each(function(){
                var check_val = $(this)
                if(check_val.val()!=""){
                  check_val.removeClass('is-invalid');
                }
            });      
        }
     }
  });
});
//แก้ไข

//validate_from_error
function show_msg_error(msg){

  $('.show-error-validate').find('ul').empty();
  $('.show-error-validate').css('display','block');
  
  $.each(msg,function(index,value){
    $('.show-error-validate').find('ul').append('<li>'+value+'</li>');
  });

}


//แบ่งหน้า
$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    var page = $(this).attr('href').split("page=")[1];
    //console.log(page);
    readPage(page);
});

function readPage(page)
{
    $.get('/admin/product/page/pagination?page='+page,null,function(data){
            //console.log(data);
            //empty กันข้อมูลมาซ้ำ
            $('.card-body').empty().html(data);
            location.hash=page;
            $("#page").val(page);
    });
}
//แบ่งหน้า

</script>
@endsection