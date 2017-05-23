<template>

    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Add Subcategory to {{ category[0].categoryName }}</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                <form>
                    <div class="field">
                        <label class="label">Subcategory name</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.subcategoryName">
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Budget Amount</label>
                        <p class="control">
                            <input class="input" type="number" v-model="form.subcategoryBudget">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <input class="input" type="hidden"  v-model="form.id">
                        </p>
                    </div>
                </form>

            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-warning" @click="onSubmit(category[0].id)">Add</a>
                <a class="button" @click="$emit('close')">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
    import Subcategory from '../models/Subcategory';
    export default {
        props: ['category'],
        data() {
            return {
                form: new Form({subcategoryName: '', subcategoryBudget: '', id: '' }),
            }
        },
        methods: {
            onSubmit(id) {
                this.$set(this.form,"id",id);
                this.form
                    .post('/subcategories/create')
                    .then(subcategory => this.$emit('completed', subcategory));
            }
        }
    }
</script>