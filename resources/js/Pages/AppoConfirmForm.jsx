import { usePage, useForm } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";

const AppoConfirmForm = () => {
    const { permalink } = usePage().props;

    const { data, setData, post, processing, errors, reset } = useForm({
        name: "",
        email: "",
        permalink: permalink,
    });

    const submit = (e) => {
        e.preventDefault();
        post(route("appoint.inertiaFilterAppoint", { permalink }), {});
    };

    return (
        <>
            <form onSubmit={submit}>
                <h2>以下の項目を記入してください</h2>
                <div className="mt-4">
                    <div>
                        <label htmlFor="name">
                            お名前
                            <span style={{ color: "red" }}>(＊必須)</span>
                        </label>
                    </div>
                    <TextInput
                        id="name"
                        type="text"
                        value={data.name}
                        required
                        onChange={(e) => setData("name", e.target.value)}
                    />
                </div>
                <div className="mt-4">
                    <div>
                        <label htmlFor="email">
                            メールアドレス
                            <span style={{ color: "red" }}>(＊必須)</span>
                        </label>
                    </div>
                    <TextInput
                        id="email"
                        type="text"
                        value={data.email}
                        required
                        onChange={(e) => setData("email", e.target.value)}
                    />
                </div>
                <PrimaryButton
                    className="mt-5 flex-center"
                    htmlFor="submit_button"
                >
                    予約を表示する
                </PrimaryButton>
            </form>
        </>
    );
};

export default AppoConfirmForm;
