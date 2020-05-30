<template>
    
   <div class="playArea">
        <h1>Play High Hand Game</h1>

        <form id="playArea">
            <!-- text -->
            <p>
                <label for="playerName">Player Name</label>
                <input type="text" id="playerName" v-model="playerName">
                {{playerName}}
            </p>
            <p>
                <label for="playerHand">Player Hand</label>
                <input type="text" id="playerHand" v-model="playerHand">
                {{playerhand}}
            </p>
          
            <p>
                <label for="generatedHand">Generated Hand</label>
                <input type="text" id="generatedHand" v-model="generatedHand" disabled>
                {{generatedHand}}
            </p>
            <p><pre>data: {{$data | json 2}}</pre></p>
        </form>
    </div>
       
</template>

<script>
export default {

data() {
    return { 
    playerName: '',
    playerHand : '',
    generatedHand : ''
    }
  }

}

    

</script>