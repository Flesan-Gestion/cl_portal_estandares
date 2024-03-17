<template>
    <div class="flex flex-column">
        <div class="flex gap-2 p-1 mt-2">
            <InputText v-model="newComment" class="flex-1" placeholder="Agrega un comentario" />
            <Button icon="pi pi-send" class="w-3rem" @click="send" />
        </div>
        <div class="flex-1 overflow-auto w-full p-1 mt-4">
            <div v-if="comments.length == 0" class="text-center">
                <span class="font-bold">No hay comentarios para mostrar aún</span>
            </div>
            <div v-if="comments.length != 0">
                <div v-for="comment in comments" class="shadow-3 border-round-md flex flex-column mb-4">
                    <span class="no-wrap-container p-2 font-bold">{{ comment.user.name }}</span>

                    <div class="border-gray-400 border-top-1"></div>

                    <span class="w-full text-justify p-2">
                        {{ comment.cm_comment }}
                    </span>

                    <span class="no-wrap-container p-2 pt-0 color-gray-500 text-sm">
                        {{ this.$utl.formatDate(new Date(comment.created_at)) }} |
                        {{ this.$utl.formatTime(new Date(comment.created_at)) }}
                    </span>
                </div>
            </div>
        </div>
    </div>


</template>
<script>
import { CommentService } from '../services/CommentService';

export default {
    emits: ['onSaveComment'],
    props: {
        standardSelected: Object,
        comments: Array,
    },
    data() {
        return {
            newComment: ''
        }
    },
    methods: {
        async send() {
            const newComment = this.newComment.trim();
            if (newComment.length == 0) {
                this.$utl.genToast(this.$tstType.COMMENT_ERROR, 'left');
                return;
            }
            this.$utl.showLoader();
            await CommentService.create(CommentService.formatNewComment(newComment, this.standardSelected?.st_id));
            this.$utl.genToast(this.$tstType.REGISTER_SUCCESS, 'left');
            this.newComment = '';
            this.$emit('onSaveComment');
        },
    }
}
</script>