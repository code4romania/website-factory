let getDataTransfer = () => new DataTransfer();

try {
    getDataTransfer();
} catch {
    getDataTransfer = () => new ClipboardEvent('').clipboardData;
}

function createFileList() {
    const files = Array.prototype.concat.apply([], arguments);
    let index = 0;
    const { length } = files;

    const dataTransfer = getDataTransfer();

    for (; index < length; index++) {
        dataTransfer.items.add(files[index]);
    }

    return dataTransfer.files;
}

export default function ({ form, maxFiles }) {
    return {
        files: [],
        fileDragging: null,
        fileDropping: null,
        humanFileSize(size) {
            const i = Math.floor(Math.log(size) / Math.log(1024));
            return (
                (size / Math.pow(1024, i)).toFixed(2) * 1 +
                " " + ["B", "kB", "MB", "GB", "TB"][i]
            );
        },
        remove(index) {
            let files = [...this.files];
            files.splice(index, 1);

            this.files = createFileList(files);
        },
        addFiles(e, form, field) {
            const files = this.$refs.input.multiple
                ? createFileList([...this.files], maxFiles ? [...e.target.files].splice(0, maxFiles) : [...e.target.files])
                : createFileList([...e.target.files]);

            this.files = files;

            form[field] = [];
            for (let i = 0; i < files.length; i++) {
                form[field].push(files[i]);
            }
        },
        dragover() {
            this.$refs.zone.classList.add("bg-primary", "bg-opacity-5");
        },
        dragleave() {
            this.$refs.zone.classList.remove("bg-primary", "bg-opacity-5");
        }
    };
}
