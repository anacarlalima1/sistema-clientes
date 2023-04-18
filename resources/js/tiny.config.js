export const defaultStyleClass = `
body.mce-content-body *{
  font-family:"Arial",
  sans-serif; !important;
  max-width:100%;
  margin:0px;
  vertical-align: baseline;
  word-break:break-all;
  white-space: normal;
} 
body.mce-content-body img{
   max-height:300px !important;
 
   max-width:100%;

}
`;

//opções padroes para a config basica e padrão
const defaultOptions = {
  language: "pt_BR",
  automatic_uploads: false,
  content_style: defaultStyleClass,
  toolbar_sticky: true,
  mobile: {
    menubar: true,
  },

  resize_img_proportional: false,
  init_instance_callback: function () {
    document
      .querySelectorAll(".tox-notification")
      .forEach((editor) => (editor.style.display = "none"));
  },
};
export const configVisualizacao = {
  plugins: ["print,autoresize"],
  toolbar: "",
  menubar: false,
  readonly: true,
  paste_data_images: true,
  ...defaultOptions,
};

export const configBasica = {
  plugins: ["lists"],
  a11y_advanced_options: false,
  menubar: false,
  toolbar:
    "undo redo | bold italic  | " +
    "alignleft aligncenter alignright alignjustify | bullist numlist checklist",

  ...defaultOptions,
};
export const configEditarQuestoes = {
  ...defaultOptions,
};
//config padrao com todas funcionalidades
export default {
  plugins: [
    "a11ychecker",
    "advlist",
    "advcode",
    "advtable",
    "anchor",
    "autolink",
    "checklist",
    "export",
    "lists",
    "link",
    "image",
    "charmap",
    "preview",
    "anchor",
    "searchreplace",
    "visualblocks",
    "powerpaste",
    "fullscreen",
    "formatpainter",
    "insertdatetime",
    "media",
    "table",
    "print",
    "help",
    "wordcount",
    "pagebreak",
    "save",
    "code",
  ],
  toolbar:
    "undo redo | blocks | formatpainter casechange  | bold italic backcolor image |" +
    "alignleft aligncenter alignright alignjustify |" +
    "bullist numlist checklist outdent indent | removeformat | a11ycheck | table | pagebreak code print save help",
  images_upload_url: "postAcceptor.php",
  // powerpaste_word_import: "clean",

  a11y_advanced_options: true,
  ...defaultOptions,
};
