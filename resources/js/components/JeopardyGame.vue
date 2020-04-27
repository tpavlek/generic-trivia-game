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

        <div v-if="isDisplayingClues">
            <clue-board></clue-board>
        </div>

        <div v-if="isShowingClue">
            <clue-show></clue-show>
        </div>
    </div>

</template>

<script>
    const STATE_WAITING_FOR_PLAYERS = 'players-joining';
    const STATE_DISPLAYING_CLUES = 'displaying-clues';
    const STATE_CLUE_SELECTED = 'clue-selected';

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
                state: STATE_CLUE_SELECTED,
            }
        },

        computed: {
            ...mapState([ 'players', 'categories' ]),
            isWaitingForPlayersToJoin()
            {
                return this.state === STATE_WAITING_FOR_PLAYERS;
            },
            isDisplayingClues()
            {
                return this.state === STATE_DISPLAYING_CLUES;
            },
            isShowingClue()
            {
                return this.state === STATE_CLUE_SELECTED;
            }
        }

    }
</script>
