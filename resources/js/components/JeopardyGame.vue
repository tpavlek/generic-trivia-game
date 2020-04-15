<template>

    <div>
        <div v-if="isWaitingForPlayersToJoin">
            <h1>Join with Session ID: {{ sessionId }}</h1>

            <div>
                <h3>Players joined</h3>
                <ul>
                    <li v-for="player in players">{{ player.name }}</li>
                </ul>
            </div>
        </div>
    </div>

</template>

<script>
    const STATE_WAITING_FOR_PLAYERS = 'players-joining';

    const EVENT_PLAYER_JOINED = 'player-joined';

    import {mapState} from 'vuex';

    export default {

        props: {
            sessionId: {
                type: String,
                required: true
            },
        },

        created() {
            this.$store.commit('joinSession', this.sessionId)
        },

        mounted() {
            // Listen for the 'NewBlogPost' event in the 'team.1' private channel
            this.$echo.channel('ZETTA').listen(EVENT_PLAYER_JOINED, ({ player }) => {
                this.$store.commit('addPlayer', player);
            });
        },

        data() {
            return {
                state: STATE_WAITING_FOR_PLAYERS,
            }
        },

        computed: {
            ...mapState([ 'players', 'categories' ]),
            isWaitingForPlayersToJoin()
            {
                return this.state
            }
        }

    }
</script>
