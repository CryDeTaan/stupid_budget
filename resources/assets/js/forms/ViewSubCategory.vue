<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Update Subcategory</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                <form>
                    <div class="field">
                        <label class="label">Subcategory Name:</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.subcategoryName" :placeholder="subcategory.subcategoryName">
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Budget Amount:</label>
                        <p class="control">
                            <input class="input" type="number" v-model="form.subcategoryBudget" :placeholder="subcategory.subcategoryBudget">
                        </p>
                    </div>
                </form>
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-primary" @click="onSubmit(subcategory.id)">Update</a>
                <a class="button" @click="$emit('close')">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {

        props: ['subcategory'],

        data() {
            return {
                form: new Form({subcategoryName: '', subcategoryBudget: ''}),
            }
        },
        methods: {
            onSubmit(subcategoryId) {
                this.form
                    .put('/subcategories/' + subcategoryId)
                    .then(subcategory => this.$emit('completed', subcategory));
            }
        }
    }
</script>