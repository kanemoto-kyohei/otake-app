import { usePage, useForm } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton";
import GuestLayout from "@/Layouts/GuestLayout";
import TextInput from "@/Components/TextInput";
import dayjs from "dayjs";
import "dayjs/locale/ja";

//なぜかmomentだとinertiaとの競合が起きるらしいのでdayjsを使う
const AppointConfirm = () => {
    const { date, time , permalink } = usePage().props;

    const { data, setData, post, processing, errors, reset } = useForm({
        selected_date_time: `${date}|${time}`,
        name: "",
        email: "",
        extra: "",
        permalink: permalink,
    });

    //nullにならないようにデフォルトで値をセットするのもあり
    dayjs.locale("ja");
    const appodate = dayjs(date).format("M月D日 (ddd)");

    const hundldeSubmit = (e) => {
        e.preventDefault();
        setData("selected_date_time", `${date}|${time}`);
        post(route("appoint.inertiaSet",{permalink}),{
            data: data
        });
    };

    return (
        <GuestLayout>
                <form onSubmit={hundldeSubmit}>
                    <div className="mt-5 flex justify-start flex-col items-center">
                        <h2>以下の項目を記入してください</h2>
                        <div className="mt-4">
                            <div>
                            <label htmlFor="name">お名前
                            <span style={{color:'red'}}>(＊必須)</span>
                            </label>
                            </div>
                            <TextInput
                                id = "name"
                                type = "text"
                                value ={data.name}
                                required
                                onChange = {(e)=> setData('name',e.target.value)}
                            />
                        </div>
                        <div className="mt-4">
                            <div>
                            <label htmlFor="email">メールアドレス
                            <span style={{color:'red'}}>(＊必須)</span>
                            </label>
                            </div>
                            <TextInput
                                id = "email"
                                type = "text"
                                value ={data.email}
                                required
                                onChange = {(e)=> setData('email',e.target.value)}
                            />
                        </div>
                        <div className="mt-4">
                            <div>
                            <label htmlFor="extra">備考</label>
                            </div>
                            <textarea
                                id = "extra"
                                type = "text"
                                value ={data.extra}
                                onChange = {(e)=> setData('extra',e.target.value)}
                                style={{borderRadius: '10px'}}
                            />
                        </div>

                        <h1 className="mt-5">以下の内容で予約を確定しますか？</h1>
                        <h1 className="mt-2">日にち：{appodate}</h1>
                        <h1>時間：{time}</h1>

                        <div className="mt-5">
                            <PrimaryButton type="submit">
                                確定する
                            </PrimaryButton>
                        </div>
                    </div>
                </form>
        </GuestLayout>
    );
};
export default AppointConfirm;
