<template>
    <div>
        <h1 class="title has-text-centered">Overview for August!</h1>
        <div class="box">
            <div class="content">
                <nav class="level is-mobile">
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading has-text-success">Income</p>
                            <p class="title">3,456</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading has-text-danger">Expenses</p>
                            <p class="title">123</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading has-text-primary">Balance</p>
                            <p class="title">456K</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading has-text-info">Balance Forecast</p>
                            <p class="title">789</p>
                        </div>
                    </div>
                </nav>

            </div>
        </div>

        <div class="columns">
            <div class="column">
                <div class="message is-dark">
                    <div class="message-body is-dark">
                        <p class="heading has-text-centered">Budget Progress</p>
                        <progress class="progress is-danger" value="90" max="100">90%</progress>
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="message is-dark">
                    <div class="message-body">
                        <p class="heading has-text-centered">Unplanned Expenses</p>
                        <h1 class="title is-1 has-text-centered">1200</h1>
                    </div>
                </div>
            </div>
        </div>




    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
