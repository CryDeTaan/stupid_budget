<template>

    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Update Income</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                <form>
                    <div class="field">
                        <label class="label">Income Date</label>
                        <p class="control">
                            <datepicker
                                    :placeholder="income.created_at | date"
                                    :config="{ dateFormat: 'Y-m-d', altInput: true, altFormat: 'd-m-Y', static: true}"
                                    v-model="form.incomeDate">
                            </datepicker>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Income Description:</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.incomeDescription" :placeholder="income.incomeDescription">
                        </p>
                    </div>

                    <div class="field">
                        <label class="label">Account:</label>
                        <p class="help is-success">
                            Currently selected: {{ income.account.accountName }}
                        </p>
                        <p class="control">
                            <span class="select is-fullwidth">
                              <select v-model="form.account_id">
                                  <option v-for="account in accounts" :value="account.id">{{ account.accountName }}</option>
                              </select>
                            </span>
                        </p>
                    </div>

                    <div class="field">
                        <label class="label">Income Amount:</label>
                        <p class="control">
                            <input class="input" type="number" v-model="form.amount" :placeholder="income.amount">
                        </p>
                    </div>

                </form>
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-success" @click="onSubmit(income.id)">Update Income</a>
                <a class="button" @click="$emit('close')">Cancel</a>
            </footer>
        </div>
    </div>
</template>
<script>

    import Account from '../models/Account'
    import Datepicker from 'vue-bulma-datepicker'

    export default {

        components: {
            Datepicker
        },

        filters: {
            date(date) {
                return moment(date, 'YYYY-MM-DD').format('DD-MM-YYYY');
            },
        },

        props: ['income'],

        data() {
            return {
                form: new Form({
                    incomeDescription: '',
                    account_id: '',
                    amount: '',
                    incomeDate: ''
                }),
                accounts: []
            }
        },

        created() {
            Account.all()
                .then(({data}) => this.accounts = data);
        },

        methods: {

            onSubmit(incomeId) {

                this.form
                    .put('/income/' + incomeId)
                    .then(income =>  this.$emit('completed', income));
            }
        }

    }


</script>