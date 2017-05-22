<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Delete Expense</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                Are you sure you want to delete the following Expense from your profile:</br></br>
                <strong>  Expense Date : </strong>
                {{ expense[0].created_at }}</br>
                <strong>  Income Description : </strong>
                {{ expense[0].expenseDescription }}</br>
                <strong>  Expense Belongs to Account : </strong>
                {{ expense[0].account.accountName }}</br>
                <strong>  Expense Belongs to Category : </strong>
                {{ expense[0].category.categoryName }}</br>
                <strong>  Expense Belongs to Subcategory : </strong>
                {{ expense[0].subcategory.subcategoryName }}</br>
                <strong>  Income Amount  : </strong>
                {{ expense[0].amount}}
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-danger" @click="onSubmit(expense[0].id)">Delete Income</a>
                <a class="button" @click="$emit('close')">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['expense'],
        methods: {
            onSubmit(expenseId) {
                axios.delete('/expenses/' + expenseId);
                this.$emit('completed', expenseId);
            }
        }
    }
</script>