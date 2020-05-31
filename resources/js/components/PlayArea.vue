<template>
    
<div class="playArea">
    <div class="container py-2">

    <h2 class="text-center text-white bg-dark">Play Game</h2>

    <p class="alert alert-info text-center">Please, enter a hand which should be less than 26 and seperated by space for example "K Q J 3 4" <br> Your hand should only include  "A K Q J 10 9 8 7 6 7 5 4 3 2"</p>

    <p v-if="errorDisplay" class="alert alert-danger text-center">{{ errorMessage }}</p>
    <p v-if="winner" class="alert alert-success text-center">{{ userWon }}</p>
    <p v-if="draw" class="alert alert-warning text-center">{{ userWon }}</p>
    
    <form id="playArea" method="POST" @submit.prevent="makePostRequest()">
        <div class="d-flex justify-content-center">
            <table class="table table-dark rounded">
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
            <input type="submit" class="btn btn-primary" v-model="playText" />
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
    draw: false,
    playText: 'Play Hand'
    }
  },

  methods: {
      
    makePostRequest() {
    let vm = this;
    vm.errorDisplay = false;
    vm.winner = false;
    vm.draw = false;
    vm.playText = "🍿 ♠ ♣ ♥ ♦ 🍿";
    axios.post('api/playerData/store', {
        data: {
            name: this.playerName,
            userHand: this.playerHand
      }})
      .then(function (response) {
            if(response){
                    vm.playText = "Play Hand";
                    vm.generatedHand = response.data.generatedHand;
                    vm.playerScore = response.data.userScore;
                    vm.compScore = response.data.compScore;
                    vm.userWon = response.data.userWon;
                    if(vm.compScore !== vm.playerScore){
                        vm.winner = true;
                        if(vm.userWon && vm.draw == false){
                            vm.userWon = 'You have defeated the computer 😀'
                        }else{
                            vm.userWon = 'Computer has defeated you 😢'
                        }
                    }
                    else{
                        vm.draw = true;
                        vm.userWon = 'This match is a draw 😢'
                    }

            }else{
                //Silent Fail
                console.log("error");
            }
            })
                .catch(function (error) {
                    vm.playText = "Play Hand"
                    vm.errorDisplay = true;
                    vm.errorMessage = error.response.data;
                });;
}
  }

}

    

</script>