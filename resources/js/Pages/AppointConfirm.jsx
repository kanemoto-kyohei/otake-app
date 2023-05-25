import { usePage, useForm } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import dayjs from "dayjs";
import "dayjs/locale/ja";

//なぜかmomentだとinertiaとの競合が起きるらしいのでdayjsを使う
const AppointConfirm = () => {
    const { date, time, auth } = usePage().props;
    const { data, setData, post, processing, errors, reset } = useForm({
        selected_date_time: `${date}|${time}`,
    });
    //nullにならないようにデフォルトで値をセットするのもあり
    dayjs.locale("ja");
    const appodate = dayjs(date).format("M月D日 (ddd)");

    const hundldeSubmit = (e) => {
        e.preventDefault();
        setData("selected_date_time", `${date}|${time}`);
        post(route("appoint.inertiaSet"));
    };

    return (
        <>
                <form onSubmit={hundldeSubmit}>
                    <div className="mt-5 flex flex-col items-center">
                        <h1>以下の内容で予約を確定しますか？</h1>
                        <h1 className="mt-2">日にち：{appodate}</h1>
                        <h1>時間：{time}</h1>
                        <div className="mt-2">
                            <PrimaryButton type="submit">
                                確定する
                            </PrimaryButton>
                        </div>
                    </div>
                </form>
        </>
    );
};
export default AppointConfirm;
