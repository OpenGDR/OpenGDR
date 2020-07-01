<template>
    <div>
        <editorVue
            ref="tuiEditor"
            :initialValue="initialValue"
            :options="editorOptions"
            initial-edit-type="wysiwyg"
            v-on:change="updateData"
        />
        <input type="hidden" :name="inputName" v-model="valueData" />
    </div>
</template>

<script>
import "codemirror/lib/codemirror.css";
import "@toast-ui/editor/dist/toastui-editor.css";
import { Editor } from "@toast-ui/vue-editor";

export default {
    components: {
        editorVue: Editor
    },
    props: {
        initialValue: {
            type: String,
            default: ""
        },
        inputName: {
            type: String,
            default: "wysiwyg"
        }
    },
    data() {
        return {
            editorOptions: {
                mode: 'wysiwyg',
                usageStatistics: false,
                language: "it-IT",
                hideModeSwitch: true,
                toolbarItems: [
                    "heading",
                    "bold",
                    "italic",
                    "strike",
                    "divider",
                    "hr",
                    "quote",
                    "divider",
                    "ul",
                    "ol",
                    "indent",
                    "outdent"
                ]
            },
            valueData: ""
        };
    },
    mounted() {
        this.valueData = this.initialValue;
    },

    methods: {
        updateData() {
            this.valueData = this.$refs.tuiEditor.invoke("getMarkdown");
        }
    }
};
</script>
