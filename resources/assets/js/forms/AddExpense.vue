<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Add expense</p>
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
                            <input class="input" type="text" v-model="form.expenseDescription" @keydown="form.errors.clear('expenseDescription')">
                            <span class="help is-danger" v-text="form.errors.get('expenseDescription')"></span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Category</label>
                        <p class="control">
                            <span class="select is-fullwidth">
                              <select v-model="form.category_id" @change="categorySelected($event)">
                                  <option value="Unplanned">Unplanned</option>
                                  <option v-for="category in categories" :value="category.id">{{ category.categoryName }}</option>
                              </select>
                            </span>
                            <span class="help is-danger" v-text="form.errors.get('category_id')"></span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Sub Category</label>
                        <p class="control">
                            <span class="select is-fullwidth">
                              <select v-model="form.subcategory_id" @change="form.errors.clear('subcategory_id')">
                                <option v-for="subcategory in subcategories"
                                        :value="subcategory.id">{{ subcategory.subcategoryName }}</option>
                              </select>
                            </span>
                            <span class="help is-danger" v-text="form.errors.get('subcategory_id')"></span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Account</label>
                        <p class="control">
                            <span class="select is-fullwidth">
                              <select v-model="form.account_id" @change="form.errors.clear('account_id')">
                                <option v-for="account in accounts" :value="account.id">{{ account.accountName
                                    }}</option>
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
                <a type="submit" class="button is-danger" @click="onSubmit()">Add</a>
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
                .then(({data}) => this.categories = data[0]);
        },

        methods: {

            onSubmit() {
                this.form
                    .post('/expenses/create')
                    .then(expense => this.$emit('completed', expense));
            },

            categorySelected(event) {
                Subcategory.all(event.target.value)
                    .then(({data}) => this.subcategories = data);
            }

        }

    }


</script>