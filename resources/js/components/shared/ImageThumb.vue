<template>
    <div class="image-wrapper" :style="'height:' + height + '; width:' + width + '; max-height:' + maxWidth + '; max-width:' + maxWidth + ';'">
        <label v-if="label">{{ label }}</label>
        <div class="image-container">
            <v-img
                :src="value ?? imagePlaceholder"
                :contain="true"
                class="grey lighten-2 mx-auto image"
                :class="errorMessages ? 'with-error' : ''"
                @click="choiceImage"
                max-width="100%"
                max-height="100%"
            />
            <div v-if="value" class="delete-container text-center">
                <v-icon
                    small
                    color="error"
                    :disabled="disabled"
                    @click="removeImage"
                >fa-solid fa-trash-can</v-icon>
            </div>
        </div>
        <span v-if="errorMessages" class="error--text">{{ errorMessages }}</span>

        <FileManagerDialog v-bind.sync="fileManager" v-on:url="setUrl"></FileManagerDialog>
    </div>
</template>

<script>
import FileManagerDialog from "./FileManagerDialog";

export default {
    name: "ImageThumb",
    components: {
        FileManagerDialog
    },
    props: {
        value: {
            type: String,
            default: null
        },
        label: {
            type: String,
            default: ''
        },
        errorMessages: {
            type: String,
            default: ''
        },
        disabled: {
            type: Boolean,
            default: false
        },
        width: {
            type: String,
            default: '250px'
        },
        height: {
            type: String,
            default: '140px'
        },
        maxWidth: {
            type: String,
            default: '250px'
        },
        maxHeight: {
            type: String,
            default: '140px'
        }
    },
    data() {
        return {
            imagePlaceholder: '/images/no-image.png',
            image: null,
            fileManager: {
                isActive: false
            }
        }
    },
    methods: {
        choiceImage() {
            this.fileManager.isActive = true;
        },
        removeImage() {
            this.image = null;
            this.fileManager.isActive = false;
            this.update();
            this.$emit('remove');
        },
        setUrl(url) {
            this.image = url;
            this.update();
        },
        update() {
            this.$emit('update:value', this.image);
        }
    }
}
</script>

<style lang="scss" scoped>
.image-wrapper {
    .image-container {
        cursor: pointer;
        position: relative;
        height: 100%;
        max-height: 100%;

        .image {
            border: 1px solid #c5c5c5 !important;
            height: 100%;
            max-height: 100%;

            &.with-error {
                border: 1px solid var(--v-error-base) !important;
            }
        }

        .delete-container {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 34px;
            padding: 5px;
            background: rgb(255, 255, 255, 0.8);
        }
    }
}
</style>
