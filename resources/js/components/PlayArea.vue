<template>
    
<div class="playArea">
    <div class="container py-2">
    <h2 class="d-flex justify-content-center">Play Game</h2><br>

    <p v-if="errorDisplay" class="alert alert-danger d-flex justify-content-center">{{ errorMessage }} 😟</p>
    <p v-if="winner" class="alert alert-success d-flex justify-content-center">{{ userWon }}</p>
    <p v-if="draw" class="alert alert-warning d-flex justify-content-center">{{ userWon }}</p>
    
    <form id="playArea" method="POST" @submit.prevent="makePostRequest()">
        <div class="d-flex justify-content-center">
        <table class="table table-dark">
            <tr>
                <td><label for="playerName">Your Name</label></td>
                <td><input type="text" placeholder="John Doe" id="playerName" v-model="playerName" required></td>
            </tr>
            <tr>
                <td><label for="playerHand">Your Hand</label></td>
                <td><input type="text" placeholder="K A Q 2 J K" id="playerHand" v-model="playerHand" required></td>
                <td>Score: {{ playerScore }}</td>
            </tr>
          
            <tr>
                <td><label for="generatedHand">Generated Hand</label></td>
                <td><input type="text" id="generatedHand" v-model="generatedHand" disabled></td>
                <td>Score: {{ compScore }}</td>
            </tr>
        </table>
        </div>
        <div class="text-center">
            <input type="submit" class="btn btn-primary" value="Play Hand" />
        </div>
    </form>
    </div>
    <hr style="border-top: 8px solid #bbb; border-radius: 5px;"></hr> 
</div>
</template>

<script>
export default {

data() {
    return { 
    playerName: '',
    playerHand : '',
    generatedHand : 'Hidden',
    compScore: 'TBD',
    playerScore: 'TBD',
    errorDisplay: false,
    errorMessage: '',
    winner: false,
    userWon: '',
    draw: false
    }
  },

  methods: {
      
    makePostRequest() {
    let vm = this;
    axios.post('api/playerData/store', {
        data: {
            name: this.playerName,
            userHand: this.playerHand
      }})
      .then(function (response) {
            if(response){
                    vm.errorDisplay = false;
                    vm.winner = false;
                    vm.draw = false;
                console.log(response);
                    vm.generatedHand = response.data.generatedHand;
                    vm.playerScore = response.data.userScore;
                    vm.compScore = response.data.compScore;
                    vm.userWon = response.data.userWon;
                    if(vm.compScore !== vm.playerScore){
                        vm.winner = true;
                        if(vm.userWon && vm.draw == false){
                            console.log(vm.userWon);
                            vm.userWon = 'You have defeated the computer 😀'
                        }else{
                            console.log(vm.userWon);
                            vm.userWon = 'Computer has defeated you 😢'
                        }
                    }
                    else{
                        console.log(vm.userWon);
                        vm.draw = true;
                        vm.userWon = 'This match is a draw 😢'
                    }

            }else{
                console.log("error");
            }
            })
                .catch(function (error) {
                    //Silent Fail
                    console.log(error.response.data);
                    vm.errorDisplay = true;
                    vm.errorMessage = error.response.data;
                });;
}
  }

}

    

</script>