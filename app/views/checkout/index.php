<!DOCTYPE html>
<!-- Tudor Nosca (678549) -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
<body>
<button class="btn btn-primary" type="button" onclick="window.location.href = '/' "><- Back</button>
    <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Your cart</span>
          </h4>
          <ul class="list-group mb-3">
            <?php for($i = 0; $i<count($merged_products); $i++){
              ?>
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <h6 class="my-0"><?php echo $merged_products[$i]->getName() . " x " . $amounts[$i]?></h6>
                  <small class="text-body-secondary"><?php echo $merged_products[$i]->getLocation()?></small>
                  <br>
                  <small class="text-body-secondary"><?php echo $merged_products[$i]->getStartTime()?></small>
                  <br>
                  <small class="text-body-secondary" style="white-space: pre-line"><?php echo $information[$i]?></small>
                </div>
                <span class="text-body-secondary">&euro;<?php echo ($merged_products[$i]->getPrice() * $amounts[$i])?></span>
              </li>
            <?php
            }
            ?>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (EUR)</span>
              <strong style="margin-left: 70%">&euro; </strong>
              <strong id="totalPrice"><?php echo $totalPrice?></strong>
            </li>
          </ul>
        </div>
          <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Billing address</h4>
            <form action="" method="POST" class="needs-validation was-validated" novalidate="">
              <div class="row g-3">
                <div class="col-sm-6">
                  <label for="firstName" class="form-label">First name</label>
                  <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>
    
                <div class="col-sm-6">
                  <label for="lastName" class="form-label">Last name</label>
                  <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>
    
                <div class="col-12">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="you@example.com">
                  <div class="invalid-feedback">
                    Please enter a valid email address.
                  </div>
                </div>
    
                <div class="col-12">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                  <div class="invalid-feedback">
                    Please enter your shipping address.
                  </div>
                </div>
    
                <div class="col-md-3">
                  <label for="zip" class="form-label">Zip</label>
                  <input type="text" class="form-control" id="zip" placeholder="" required="">
                  <div class="invalid-feedback">
                    Zip code required.
                  </div>
                </div>

                  <div class="col-md-3">
                      <label for="phoneNumber" class="form-label">Phone number</label>
                      <input type="text" class="form-control" id="phoneNumber" placeholder="+31 6 20 87 45 18" required="">
                      <div class="invalid-feedback">
                          Phone number required.
                      </div>
                  </div>
              </div>

              <hr class="my-4">
    
              <h4 class="mb-3">Payment</h4>
    
              <div class="my-3">
                <div class="form-check">
                  <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked="" required="">
                  <label class="form-check-label" for="credit">Credit card</label>
                </div>
                <div class="form-check">
                  <input id="ideal" name="paymentMethod" type="radio" class="form-check-input" required="">
                  <label class="form-check-label" for="ideal">iDeal</label>
                </div>
              </div>
          </form>
            <hr class="my-4">
  
            <button class="w-100 btn btn-success btn-lg" type="submit" onclick="submitData()">Checkout</button>
      </div>
  </div>

  <script>
      var totalPrice = document.getElementById("totalPrice");

      console.log(parseInt(totalPrice.innerText));
      
      var firstName = document.getElementById("firstName");
      var lastName = document.getElementById("lastName");
      var email = document.getElementById("email");
      var address = document.getElementById("address");
      var zip = document.getElementById("zip");
      const zipRegEx = /^\d{4}[a-zA-Z]{2}$/;
      var phoneNumber = document.getElementById("phoneNumber");
      const phoneNumberRegEx = /^(\\+31|0)[1-9]{1}[0-9]{8}$/; // valid phone number format for the Netherlands

      var credit = document.getElementById("credit");
      var ideal = document.getElementById("ideal");

    function submitData(){
      if(invalidData()){
        var paymentMethod;

        if(credit.checked){
          paymentMethod = "creditcard";
        } else{
          paymentMethod = "ideal";
        }

        const paymentData =
        {
          first_name: firstName.value.trim(),
          last_name: lastName.value.trim(),
          email: email.value.trim(),
          address: address.value.trim(),
          zip: zip.value.trim(),
          phone_number: phoneNumber.value.trim(),
          payment_method: paymentMethod,
          total: parseInt(totalPrice.innerText)
        };

        console.log(paymentData);

        fetch("http://localhost/api/checkout",{
          method: 'POST',
          headers: {'Content-Type' : 'application/json',},
          body: JSON.stringify(paymentData),
        })
        .then((data)=> {console.log('Output: ', data);
        })
        .then(() => {window.location.href = '/checkout/payment?total=' + paymentData.total + "&paymentmethod=" + paymentMethod;})
        .catch(error => {console.error('ERROR: ', error);
        });
      }else{
        window.alert('Invalid input. Please try again.');
      }
    }
    function invalidData(){
      return (firstName.value.trim() == "" || lastName.value.trim() == "" || email.value.trim() == "" || address.value.trim() == ""
              || !zipRegEx.test(zip.value.trim()) || !phoneNumberRegEx.test(phoneNumber.value.trim()) || (!credit.checked && !ideal.checked));
    }
  </script>
</body>
</html>