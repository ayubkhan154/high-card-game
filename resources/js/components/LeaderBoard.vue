<template>

<div id="leaderBoard">
    <h2 class="text-center text-white bg-dark">Leader Board</h2>
    <div v-if="scores.length>1">
        <table class="table table-striped">
            <thead class="thead-dark text-center">
                <tr>
                <th scope="col">Index</th>
                <th scope="col">Player Name</th>
                <th scope="col">Games Won</th>
                <th scope="col">Total Games Played</th>
                </tr>
            </thead>
            <tbody>
            <tr class="results text-center" v-for="(score, index) in scores" v-bind:index="index" v-bind:key="score.id">
            <td>{{ index+=1 }}</td>
            <td>{{ score.name }}</td>
            <td>{{ score.userWon }}</td>
            <td>{{ score.total }}</td>
            </tr>
            </tbody>
       </table>
    </div>
    <div v-else class="text-center alert alert-info">
        There are no players to display...
    </div>
</div>

</template>

<script>
export default {

    data() {
        return{
            scores: [],
            score: {
                id: '',
                name: '',
                total: '',
                userWon: '',
            },
        }
    },

   created() {
        this.fetchGames();
    },

    methods: {
        fetchGames() {
            let vm = this;
            axios.get('api/playerData')
                .then(function (response) {
                vm.scores = response.data;
            })
            .catch(function (error) {
                // Silent Fail
            })
            .then(function () {
                // always executed
            });
        }

    }
}
</script>