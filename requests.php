<?php
session_start();
require_once 'db.php';

require_once 'parts/sessionCheck.php';

//is the user an admin
$sql = "SELECT `id` FROM `fadmin` WHERE `id`=$userId";
$result = $conn->query($sql);
//if not admin
if ($result->num_rows <1) {
    header('Location:index.php?status=noAccess');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <?php require_once 'parts/headLinks.php'; ?>
    <title>Join Requests</title>

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
<div id="app">
    <div class="container my-5 px-4 py-4  overflow-auto">
   <div> <h2>Join Requests</h2></div>
    <div class="table-responsive">
           
                <table class="table table-hover text-center shadow rounded" id="requests">
                    <thead>
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Request Date</th>
                            <th scope="col">Actions</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <!-- requests will show here--->
                      <!---  <tr v-for="request in requests" data-id="{{request.id}}">
                            <td>{{request.email}}</td>
                            <td>{{request.date}}</td>
                            <td>
                                <span>
                                <a><button type="button" class="btn btn-success approveBtn"><i class="fas fa-user-plus"></i> Approve</button></a>
                                </span> 
                                <span class="ml-3">
                                <a><button type="button" class="btn btn-danger declineBtn"> <i class="fas fa-user-times"></i> Decline</button></a>
                                </span>
                            </td>
                        </tr> -->
                    </tbody>


                </table>
                
        </div>
        <div class="d-none d-flex justify-content-center" >
            <div class="shadow main text-center px-5 py-5 d-none" id="msgNoRequests">
            <h4>You don't have new requests<h4>
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

<!-- <script> -->
    // new Vue({
    //   el: "#app",
    //   data() {
    //     return {
    //       user: {
    //         // firstName: $userId,
    // //         lastName: "",
    // //         bio: "",
    // //         favColor: "",
    // //         githubURL: "",
    // //         hobbies: [],
    // //         birthday: ""
    //       },
    // //       hobbies: ["Running", "Gaming", "Surffing", "Watch TV", "Books"],
    // //       searchedHobbie: "",
    //     }
    //   },
    //   computed:{
    // //     filterdHobbies() {
    // //       if (this.searchedHobbie) {
    // //         let filteredHobbies = this.hobbies.filter((hobbie) => {
    // //           return hobbie.toLowerCase().includes(this.searchedHobbie.toLowerCase());
    // //         })
    // //         return filteredHobbies;
    // //       }
    // //       else
    // //         return this.hobbies;
    // //     },
    // //     fixedGitHubURL() {
    // //       if (!this.user.githubURL.startsWith("http://") && !this.user.githubURL.startsWith("https://"))
    // //         return "https://" + this.user.githubURL;
    // //       else
    // //         return this.user.githubURL;
    // //     },
    // //     fullName(){
    // //       return `${this.user.firstName} ${this.user.lastName}`;
    // //     },
    // //     calculateAge() { // birthday is a date
    // //       birthdayDate = new Date(this.user.birthday);
    // //       let ageDifMs = Date.now() - birthdayDate.getTime();
    // //       let ageDate = new Date(ageDifMs); // miliseconds from epoch
    // //       return Math.abs(ageDate.getUTCFullYear() - 1970);
    // //     }
    //   },
    //   methods: {
    // //     getRequests() {
    // //       console.log(JSON.stringify(this.user));
    // //     }
    // //     ,
    // //     clearHobbies() {
    // //       this.user.hobbies = [];
    // //     },
    //   },
    //   filters: {
    // //     capitalize: function (value) {
    // //       return nameCapitalized = value.charAt(0).toUpperCase() + value.slice(1)
    // //     },
    //   }
    // });
  <!-- </script> -->
</body>
<?php $conn->close(); ?>
</html>