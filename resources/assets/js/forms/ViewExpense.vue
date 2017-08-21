<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Update Expense</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                <form>
                    <div class="field">
                        <label class="label">Expense Date</label>
                        <p class="control">
                            <datepicker
                                    :placeholder="expense.created_at | date"
                                    :config="{ dateFormat: 'Y-m-d', altInput: true, altFormat: 'd-m-Y', static: true}"
                                    v-model="form.expenseDate">
                            </datepicker>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Expense Description:</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.expenseDescription" :placeholder="expense.expenseDescription">
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Select Expense Category:</label>
                        <p class="help is-danger">
                            Currently selected: {{ expense.category.categoryName }}
                        </p>
                        <p class="control">
                            <span class="select is-fullwidth">
                              <select v-model="form.category_id" @change="categorySelected($event)">
                                  <option value="Unplanned">Unplanned</option>
                                  <option v-for="category in categories[0]" :value="category.id">{{ category.categoryName}}</option>
                              </select>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Select Expense Subcategory: {{ expense.subcategory.subcategoryName }}</label>
                        <p class="help is-danger">
                            Currently selected: {{ expense.subcategory.subcategoryName }}
                        </p>
                        <p class="control">
                            <span class="select is-fullwidth">
                              <select v-model="form.subcategory_id">
                                  <option value="Unplanned">Unplanned</option>
                                  <option v-for="subcategory in subcategories" :value="subcategory.id">{{ subcategory.subcategoryName }}</option>
                              </select>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Select Account:</label>
                        <p class="help is-danger">
                            Currently selected: {{ expense.account.accountName }}
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
                        <label class="label">Expense Amount:</label>
                        <p class="control">
                            <input class="input" type="number" v-model="form.amount" :placeholder="expense.amount">
                        </p>
                    </div>
                </form>
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-danger" @click="onSubmit(expense.id)">Update Expense</a>
                <a class="button" @click="$emit('close')">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>

    import Account from '../models/Account'
    import Category from '../models/Category'
    import Subcategory from '../models/Subcategory'
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

        props: ['expense'],

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
                categories: [],
                subcategories: [],
            }

        },

        created() {
            Account.all()
                .then(({data}) => this.accounts = data);
            Category.all()
                .then(({data}) => this.categories = data);
        },

        methods: {

            categorySelected(event) {
                Subcategory.all(event.target.value)
                    .then(({data}) => this.subcategories = data);
            },

            onSubmit(expenseId) {
                this.form
                    .put('/expenses/' + expenseId)
                    .then(expense => this.$emit('completed', expense));
            }

        }

    }


</script>