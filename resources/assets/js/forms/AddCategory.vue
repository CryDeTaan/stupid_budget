<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Add Category</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                <form>
                    <div class="field">
                        <label class="label">Category</label>
                        <p class="control">
                            <input class="input" type="text" v-model="form.categoryName" @keydown="form.errors.clear('categoryName')">
                            <span class="help is-danger" v-text="form.errors.get('categoryName')"></span>
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
    import Category from '../models/Category';
    export default {
        data() {
            return {
                form: new Form({categoryName: ''})
            }
        },
        methods: {
            onSubmit() {
                this.form
                    .post('/categories/create')
                    .then(category => this.$emit('completed', category));
            }
        }
    }
</script>