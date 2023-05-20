import { usePage, Head, useForm } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import PrimaryButton from "@/Components/PrimaryButton";
import Select from "react-select";
import Checkbox from "@/Components/Checkbox";
import React from "react";

const Setting = () => {
    const { flash, auth } = usePage().props;
    const { data, setData, post } = useForm({
        start_time: "",
        end_time: "",
        time_interval: "",
        holiday_setting: false,
        weekday_slots: [],
    });

    //ここが文字列として返されているので後々の計算時にエラーが起きる
    const times = [
        { label: 5 },
        { label: 6 },
        { label: 7 },
        { label: 8 },
        { label: 9 },
        { label: 10 },
        { label: 11 },
        { label: 12 },
        { label: 13 },
        { label: 14 },
        { label: 15 },
        { label: 16 },
        { label: 17 },
        { label: 18 },
        { label: 19 },
        { label: 20 },
        { label: 21 },
        { label: 22 },
        { label: 23 },
        { label: 24 },
    ];
    const time_interval = [{ label: 0.5 }, { label: 1 }, { label: 2 }];

    const weekdays = [
        { value: "月", id: 1 },
        { value: "火", id: 2 },
        { value: "水", id: 3 },
        { value: "木", id: 4 },
        { value: "金", id: 5 },
        { value: "土", id: 6 },
        { value: "日", id: 7 },
    ];
    function submit(e) {
        e.preventDefault();
        post(route("admin.inertiaSave"));
    }

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="MyCalendar" />
            {flash.message && (
                <div className="text-center">
                    <div style={{ color: "red" }}>{flash.message}</div>
                </div>
            )}
            {flash.error && (
                <div className="text-center">
                    <div style={{ color: "red" }}>{flash.error}</div>
                </div>
            )}

            <form onSubmit={submit}>
                <div className="flex flex-col items-center mt-6">
                    <p htmlFor="start_time">開始時間</p>
                    <div className="flex items-center">
                        <Select
                            options={times}
                            name="start_time"
                            id="start_time"
                            placeholder={"開始時間を選択してください"}
                            onChange={(selectedOption) =>
                                setData("start_time", selectedOption.label)
                            }
                            required
                            className="w-70 ml-9"
                        />
                        <span className="text-lg ml-2">:00</span>
                    </div>
                    <p htmlFor="end_time">終了時間</p>
                    <div className="flex items-center">
                        <Select
                            options={times}
                            id="end_time"
                            name="end_time"
                            placeholder={"終了時間を選択してください"}
                            onChange={(selectedOption) =>
                                setData("end_time", selectedOption.label)
                            }
                            required
                            className="w-70 ml-9"
                        />
                        <span className="text-lg ml-2">:00</span>
                    </div>
                    <p htmlFor="time_interval">時間刻み</p>
                    <div className="flex items-center">
                        <Select
                            options={time_interval}
                            id="time_interval"
                            name="time_interval"
                            placeholder={"時間間隔を選択してください"}
                            onChange={(selectedOption) =>
                                setData("time_interval", selectedOption.label)
                            }
                            required
                            className="w-70"
                        />
                    </div>

                    <p className="mt-3">休日にする曜日を選択してください</p>
                    <div className="flex flex-wrap">
                        {weekdays.map((weekday) => {
                            return (
                                <>
                                    <Checkbox
                                        name={weekday.id}
                                        checked={data.weekday_slots.includes(
                                            weekday.id
                                        )}
                                        onChange={(e) => {
                                            if (e.target.checked) {
                                                setData("weekday_slots", [
                                                    ...data.weekday_slots,
                                                    weekday.id,
                                                ]);
                                            } else {
                                                setData(
                                                    "weekday_slots",
                                                    data.weekday_slots.filter(
                                                        (id) =>
                                                            id !== weekday.id
                                                    )
                                                );
                                            }
                                        }}
                                    />

                                    <span
                                        className="ml-1 mr-3"
                                        htmlFor={`weekday_${weekday.id}`}
                                    >
                                        {weekday.value}
                                    </span>
                                </>
                            );
                        })}
                    </div>
                    <div className="block mt-4">
                        <p>祝日を休日から外しますか？</p>
                        <label className="flex items-center">
                            <Checkbox
                                name="holiday_setting"
                                checked={data.holiday_setting}
                                onChange={(e) =>
                                    setData("holiday_setting", e.target.checked)
                                }
                            />
                            <span className="ml-2 text-sm text-gray-600">
                                祝日を休日から外す
                            </span>
                        </label>
                    </div>
                    <PrimaryButton
                        className="mt-5 flex-center"
                        htmlFor="submit_button"
                    >
                        送信
                    </PrimaryButton>
                </div>
            </form>
        </AuthenticatedLayout>
    );
};
export default Setting;
