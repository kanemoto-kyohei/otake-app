export default function ApplicationLogo(props) {
    return (
        //publicのすぐ配下に設置して、相対パスを入力すればOK
        <img src="/images/mycalendarlogo.png" alt="App Logo" {...props} />
        );
}
