import { usePage, useForm } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton";
import GuestLayout from "@/Layouts/GuestLayout";
import dayjs from "dayjs";
import "dayjs/locale/ja";

const Delete = () => {
    const { date, time, id, auth, permalink } = usePage().props;
    const { setData, post } = useForm({
        selected_id: `${id}`,
    });
    console.log(permalink);

    dayjs.locale("ja");
    const appodate = dayjs(date).format("M月D日 (ddd)");

    const hundldeSubmit = (e) => {
        e.preventDefault();
        setData("selected_id", `${id}`);
        post(route("appoint.inertiaDelete", { permalink }));
    };

    return (
        <>
            <GuestLayout user={auth.user}>
                <form onSubmit={hundldeSubmit}>
                    <div className="mt-5 flex flex-col items-center">
                        <h1>以下の予約をキャンセルしますか？</h1>
                        <h1 className="mt-2">日にち：{appodate}</h1>
                        <h1>時間：{time}</h1>
                        <div className="mt-2">
                            <PrimaryButton type="submit">
                                キャンセルする
                            </PrimaryButton>
                        </div>
                    </div>
                </form>
            </GuestLayout>
        </>
    );
};
export default Delete;
