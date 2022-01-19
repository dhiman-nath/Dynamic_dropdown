<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    
  </head>
  <body>
  <div class="container col-md-6-sm-12">
  <form id='create' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="needs-validation"
    novalidate >
    <div id="status"></div>
    <div class="form-row">
    <div class="form-group col-md-4 col-sm-12">
            <label for=""> Select Country </label>
            <select id="country_id" name="country_id" class="form-control">
                            @foreach($countries['data'] as $country)
                               <option value="{{ $country->id }}">{{$country->CountryName}}</option>
                             @endforeach
            </select>
            <span id="error_name" class="has-error"></span>
        </div>
    </div>

    <div class="form-group col-md-4 col-sm-12" id="subcategory_dropdown">
            <label for=""> Select City </label>
            <select id="city_id" name="city_id" class="form-control">
                           
            <option >-- Select City --</option>
                             
            </select>
            <span id="error_subcategory_id" class="has-error"></span>
    </div>

    <div class="form-group col-md-4 col-sm-12" id="subcategory_dropdown">
            <label for=""> Select Area </label>
            <select id="area_id" name="area_id" class="form-control">
                           
            <option >-- Select Area --</option>
                             
            </select>
            <span id="error_subcategory_id" class="has-error"></span>
    </div>

</form>
</div>
<!-- Script -->
<script type='text/javascript'>

$(document).ready(function(){

  // Department Change
  $('#country_id').change(function(){

     // Department id
     var id = $(this).val();

     // Empty the dropdown
     $('#city_id').find('option').not(':first').remove();

     // AJAX request 
     $.ajax({
       url: 'getCities/'+id,
       type: 'get',
       dataType: 'json',
       success: function(response){
          // console.log(response);

         var len = 0;
         if(response['data'] != null){
           len = response['data'].length;
         }

         if(len > 0){
           // Read data and create <option >
           for(var i=0; i<len; i++){

             var id = response['data'][i].id;
             var name = response['data'][i].CityName;

             var option = "<option value='"+id+"'>"+name+"</option>"; 

             $("#city_id").append(option); 
           }
         }

       }
    });
  });


$('#city_id').change(function(){

var id = $(this).val();


$('#area_id').find('option').not(':first').remove();


$.ajax({
  url: 'getAreas/'+id,
  type: 'get',
  dataType: 'json',
  success: function(response){
     // console.log(response);

    var len = 0;
    if(response['data'] != null){
      len = response['data'].length;
    }

    if(len > 0){
      // Read data and create <option >
      for(var i=0; i<len; i++){

        var id = response['data'][i].id;
        var name = response['data'][i].AreaName;

        var option = "<option value='"+id+"'>"+name+"</option>"; 

        $("#area_id").append(option); 
      }
    }

  }
});
});

});

</script>
   

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
