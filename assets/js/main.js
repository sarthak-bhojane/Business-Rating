

$(document).ready(function(){

    // ADD BUSINESS
    $("#saveBusiness").click(function(){

        var data = {
            name: $("#name").val(),
            address: $("#address").val(),
            phone: $("#phone").val(),
            email: $("#email").val()
        };

        $.post("ajax/add_business.php", data, function(response){

            if(response == "success"){
                location.reload();
            }

        });

    });

    // DELETE
    $(document).on('click', '.deleteBtn', function(){
        if(confirm("Are you sure?")){
            var id = $(this).data("id");

            $.post("ajax/delete_business.php", {id:id}, function(){
                $("#row_"+id).remove();
            });
        }
    });

    // INITIALIZE RATINGS
    $(".rating").each(function(){
        var business_id = $(this).data("id");
        var element = $(this);

        // Load average rating from database
        $.post("ajax/get_average_rating.php",
        {business_id:business_id},
        function(avg){
            console.log("Business ID: " + business_id + ", Average Rating: " + avg);
            var scoreValue = parseFloat(avg) || 0;
            console.log("Parsed Average: " + scoreValue);
            
            element.raty({
                starType: 'i',
                half: false,
                score: scoreValue,
                click: function(score){
                    console.log("Rating clicked: " + score);
                    // Open rating modal and save the score
                    $("#rating_business_id").val(business_id);
                    $("#rating_score").val(score);
                    $("#rating_display").text("You selected: " + score + " stars");
                    $("#ratingModal").modal('show');
                },
                starOn: 'fa fa-star text-warning',
                starOff: 'fa fa-star text-secondary'
            });
        });

    });

    // SUBMIT RATING FORM
    $("#submitRating").click(function(){
        var business_id = $("#rating_business_id").val();
        var name = $("#rating_name").val();
        var email = $("#rating_email").val();
        var phone = $("#rating_phone").val();
        var rating = $("#rating_score").val();

        if(!name || !email || !phone){
            alert("Please fill all fields");
            return;
        }

        $.post("ajax/submit_rating.php", {
            business_id: business_id,
            name: name,
            email: email,
            phone: phone,
            rating: rating
        }, function(response){
            console.log("Response: " + response);
            if(response == "success"){
                alert("Rating submitted!");
                
                // Clear form
                $("#ratingForm")[0].reset();
                $("#ratingModal").modal('hide');
                
                // Reload the rating display
                $.post("ajax/get_average_rating.php",
                {business_id:business_id},
                function(newAvg){
                    console.log("New average: " + newAvg);
                    $(".rating[data-id='"+business_id+"']").raty('score', parseFloat(newAvg));
                });
            } else {
                alert("Error submitting rating");
            }
        });
    });

});
