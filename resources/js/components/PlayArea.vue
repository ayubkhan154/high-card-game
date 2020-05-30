<template>
    
   <div class="playArea">
        <h1>Play High Hand Game</h1>
<div class="container py-2">
    <form id="playArea" method="POST" @submit.prevent="makePostRequest()">
        <table>
            <!-- text -->
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
        <input type="submit" class="btn btn-primary" value="Play Hand" />
        
        <p><pre>data: {{$data | json 2}}</pre></p>
        </form>
        </div>
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
    playerScore: 'TBD'
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
                    vm.generatedHand = response.data.generatedHand;
                    vm.playerScore = response.data.userScore;
                    vm.compScore = response.data.compScore;

                })
                .catch(function (error) {
                    //Silent Fail
                });;
}
  }

}

    

</script>