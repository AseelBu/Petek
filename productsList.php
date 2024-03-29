<?php
session_start();
require_once 'db.php';

require_once 'parts/sessionCheck.php';
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <?php require_once 'parts/headLinks.php'; ?>
    <title>Products List</title>

</head>

<body>

    <header>
        <div class="fixed-top">
            <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                <?php require 'parts/header.php'; ?>

        </div>
        </nav>
        </div>
    </header>

    <div class="container my-5 px-4 py-4  overflow-auto">
   <div> <h2>Previously Bought Products</h2></div>
   <div id="doneProducts">

    <div v-if="empty===false" class="table-responsive d-flex justify-content-center pt-2">
           
      <table class="table table-hover text-center shadow rounded col-10" id="products">
        <thead>
          <tr>
            <th v-for="title in titles" scope="col">{{title}}</th>
                            
          </tr>
        </thead>
        <tbody>
          <!-- products will show here--->
            <tr  v-for="product in doneProducts" v-bind:data-id="product.id"> 
                        
              <td class="name d-flex justify-content-center" title="Double click to edit">{{product.name}}
                <!-- <span v-if="editing===false" @dblclick="editProductName" ></span>
                  <input v-else-if="editing===true" class="thVal form-control col-6 py-3 text-center" type="text" v-bind:value="product.name" > -->
              </td>
                         
              <td class="actions ">
                <a href="#" class="btnRemoveProduct">
                    <i class="fas fa-times fa-lg"></i>
                  </a>
              </td>
            </tr>
        </tbody>

      </table>
                
    </div>
    <div v-else-if="empty === true" class=" d-flex justify-content-center" >
        <div class="shadow main text-center px-5 py-5 " id="msgNoRequests">
          <h4>You don't have new requests<h4>
        </div>
    </div>
    </div>
        
        <div>
                <input type="hidden" id="userId" name="userId" value="<?= $userId ?>">
                <input type="hidden" id="familyId" name="familyId" value="<?= $familyId ?>">
    
        </div>
</div>

    <?php require_once 'parts/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="scripts/general.js"></script>

<!-- <script>
    new Vue({
      el: "#app",
      data() {
        return {
          user: {
            // firstName: $userId,
    //         lastName: "",
    //         bio: "",
    //         favColor: "",
    //         githubURL: "",
    //         hobbies: [],
    //         birthday: ""
          },
    //       hobbies: ["Running", "Gaming", "Surffing", "Watch TV", "Books"],
    //       searchedHobbie: "",
        }
      },
      computed:{
    //     filterdHobbies() {
    //       if (this.searchedHobbie) {
    //         let filteredHobbies = this.hobbies.filter((hobbie) => {
    //           return hobbie.toLowerCase().includes(this.searchedHobbie.toLowerCase());
    //         })
    //         return filteredHobbies;
    //       }
    //       else
    //         return this.hobbies;
    //     },
    //     fixedGitHubURL() {
    //       if (!this.user.githubURL.startsWith("http://") && !this.user.githubURL.startsWith("https://"))
    //         return "https://" + this.user.githubURL;
    //       else
    //         return this.user.githubURL;
    //     },
    //     fullName(){
    //       return `${this.user.firstName} ${this.user.lastName}`;
    //     },
    //     calculateAge() { // birthday is a date
    //       birthdayDate = new Date(this.user.birthday);
    //       let ageDifMs = Date.now() - birthdayDate.getTime();
    //       let ageDate = new Date(ageDifMs); // miliseconds from epoch
    //       return Math.abs(ageDate.getUTCFullYear() - 1970);
    //     }
      },
      methods: {
    //     getproducts() {
    //       console.log(JSON.stringify(this.user));
    //     }
    //     ,
    //     clearHobbies() {
    //       this.user.hobbies = [];
    //     },
      },
      filters: {
    //     capitalize: function (value) {
    //       return nameCapitalized = value.charAt(0).toUpperCase() + value.slice(1)
    //     },
      }
    });
  </script> -->
</body>
<?php $conn->close(); ?>
</html>