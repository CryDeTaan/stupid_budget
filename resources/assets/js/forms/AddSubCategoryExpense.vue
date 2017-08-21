<template>

    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Add Expense to {{ subcategory[0].subcategoryName }} </p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                    <form>
                        <div class="field">
                            <label class="label">Expense Date</label>
                            <p class="control">
                                <datepicker
                                        placeholder="Today"
                                        :config="{ dateFormat: 'Y-m-d', altInput: true, altFormat: 'd-m-Y', static: true}"
                                        v-model="form.expenseDate">
                                </datepicker>
                            </p>
                        </div>
                        <div class="field">
                            <label class="label">Description</label>
                            <p class="control">
                                <input class="input" type="text" v-model="form.expenseDescription">
                            </p>
                        </div>
                        <div class="field">
                            <label class="label">Account</label>
                            <p class="control">
                            <span class="select is-fullwidth">
                              <select v-model="form.account_id">
                                <option v-for="account in accounts" :value="account.id">{{ account.accountName }}</option>
                              </select>
                            </span>
                            </p>
                        </div>
                        <div class="field">
                            <label class="label">Amount</label>
                            <p class="control">
                                <input class="input" type="number" v-model="form.amount">
                            </p>
                        </div>
                    </form>
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-primary" @click="onSubmit()">Add</a>
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

        props: ['subcategory'],

        data() {
            return {
                form: new Form({
                    expenseDescription: '',
                    category_id: '',
                    subcategory_id: '',
                    account_id: '',
                    amount: '',
                    expenseDate: ''
                }),
                accounts: [],
            }
        },

        created() {
            Account.all()
                .then(({data}) => this.accounts = data);
        },

        methods: {
            onSubmit() {

                this.$set(this.form,"category_id",this.subcategory[0].category_id);
                this.$set(this.form,"subcategory_id",this.subcategory[0].id);

                this.form
                    .post('/expenses/create')
                    .then(expense => this.$emit('completed', expense[0]));
            }
        }
    }
</script>