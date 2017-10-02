<template>

    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Add Income</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">

                <form>
                    <div class="field">
                        <label class="label">Income Date</label>
                        <p class="control">
                            <datepicker
                                    placeholder="Today"
                                    :config="{ dateFormat: 'Y-m-d', altInput: true, altFormat: 'd-m-Y', static: true}"
                                    v-model="form.incomeDate">

                            </datepicker>
                        </p>
                    </div>

                    <div class="field">
                        <label class="label">Description</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.incomeDescription" @keydown="form.errors.clear('incomeDescription')">
                            <span class="help is-danger" v-text="form.errors.get('incomeDescription')"></span>
                        </p>
                    </div>

                    <div class="field">
                        <label class="label">Select Account</label>
                        <p class="control">
                            <span class="select is-fullwidth" >
                              <select v-model="form.account_id" @change="form.errors.clear('account_id')">
                                <option v-for="account in accounts" :value="account.id">{{ account.accountName }}</option>
                              </select>
                            </span>
                            <span class="help is-danger" v-text="form.errors.get('account_id')"></span>
                        </p>
                    </div>

                    <div class="field">
                        <label class="label">Amount</label>
                        <p class="control">
                            <input class="input" type="number" v-model="form.amount" @keydown="form.errors.clear('amount')">
                            <span class="help is-danger" v-text="form.errors.get('amount')"></span>
                        </p>
                    </div>

                </form>
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-success" @click="onSubmit()">Add</a>
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
            onSubmit() {
                this.form
                    .post('/income/create')
                    .then(income => this.$emit('completed', income));
            }
        }

    }


</script>