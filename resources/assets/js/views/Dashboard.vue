<template>
    <div>
        <h1 class="title has-text-centered">Overview for October!</h1>
        <div class="box">
            <div class="content">
                <nav class="level is-mobile">
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading has-text-success">Income</p>
                            <p class="title">{{ overview.Income | currency }}</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading has-text-danger">Expenses</p>
                            <p class="title">{{ overview.Expense | currency }}</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading has-text-primary">Balance</p>
                            <p class="title">{{ overview.Balance | currency }}</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading has-text-info">Balance Forecast</p>
                            <p class="title">{{ overview.Balance_Forecast | currency }}</p>
                        </div>
                    </div>
                </nav>

            </div>
        </div>

        <div class="columns">
            <div class="column">
                <div class="message is-dark">
                    <div class="message-body">
                        <p class="heading has-text-centered">Budget Progress</p>
                        <progress class="progress" :class=overview.Budget_Progress :value=overview.Budget_Used :max=overview.Budget_Total></progress>
                        <p>Budget Used: {{ overview.Budget_Used | currency }}</p>
                        <p>Budget Amount: {{ overview.Budget_Total | currency }}</p>
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="message is-danger">
                    <div class="message-body" style="padding-bottom: 50px">
                        <p class="heading has-text-centered">Unplanned Expenses</p>
                        <h1 class="title is-1 has-text-centered">{{ overview.Unplanned_Expenses | currency }}</h1>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import Overview from '../models/Overview'

    export default {
        components: {

        },

        data() {
            return {
                overview: []
            }
        },

        filters: {
            currency(amount) {
                let val = (amount/1).toFixed(2).replace('.', ',');
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");

            }
        },

        created() {
            Overview.all().then(({data}) => this.overview = data);
        }

    }
</script>
