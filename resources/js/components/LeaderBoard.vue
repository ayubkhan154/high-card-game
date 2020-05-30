<template>

    <div id="leaderBoard">
        <h2>Leader Board</h2>

            <table class="table table-striped">
                <thead class="thead-dark text-center">
                    <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">Player Name</th>
                    <th scope="col">Player Score</th>
                    <th scope="col">Computer Score</th>
                    </tr>
                </thead>
                <tbody>
                <tr class="results text-center" v-for="(score, index) in scores" v-bind:index="index" v-bind:key="score.id">
                <td>{{ index+=1 }}</td>
                <td>{{ score.name }}</td>
                <td>{{ score.userScore }}</td>
                <td>{{ score.compScore }}</td>
                </tr>
                </tbody>
            </table>
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
                userScore: '',
                compScore: '',
                userWon: ''
            },
        }
    },

   created() {
        this.fetchGames();
    },

    methods: {
        fetchGames() {
            let vm = this;
            axios.get('http://127.0.0.1:8000/api/playerData')
                .then(function (response) {
                vm.scores = response.data;
                console.log(response.data);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
        }

    }
}
</script>