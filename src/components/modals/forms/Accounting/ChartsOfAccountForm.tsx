import { useState } from 'react';
import { BaseForm } from '@app/components/common/forms/BaseForm/BaseForm';
import * as S from './Accounting.styles';
import { Button } from '@app/components/common/buttons/Button/Button';
import { mergeBy } from '@app/utils/utils';
import { Col, Row } from 'antd';
import { Input, TextArea } from '@app/components/common/inputs/Input/Input';
import { useTranslation } from 'react-i18next';
import { notificationController } from '@app/controllers/notificationController';
import { Spinner } from '@app/components/common/Spinner/Spinner';
import { Select } from '@app/components/common/selects/Select/Select';

interface IChartsOfAccount {
  open: boolean;
  setOpen: (e: boolean) => void;
}

interface FieldData {
  name: string | number;
  value: any;
}

interface FormValues {
  [key: string]: string | undefined;
}

export const ChartsOfAccountForm: React.FC<IChartsOfAccount> = (
  collectionForm: IChartsOfAccount,
) => {
  const { t } = useTranslation();

  const { open, setOpen } = collectionForm;
  const [isLoading, setIsLoading] = useState(false);
  const [form] = BaseForm.useForm();
  const [fields, setFields] = useState<FieldData[]>([
    { name: 'name', value: '' },
    { name: 'glCode', value: '' },
    { name: 'type', value: '' },
    { name: 'note', value: '' },
  ]);

  const fieldUi: FormValues = {
    name: t('forms.fields.field', { name: `Account Name` }),
    glCode: t('forms.fields.field', { name: `GL Code` }),
    type: t('forms.fields.field', { name: `Type` }),
    note: t('forms.fields.field', { name: `Note` }),
  };

  const accountType = [
    { label: 'Expense', value: 'expense' },
    { label: 'Asset', value: 'asset' },
    { label: 'Equity', value: 'equity' },
    { label: 'Liability', value: 'liability' },
    { label: 'Income', value: 'income' },
  ]

  const handleSubmit = (e: any) => {
    e.preventDefault();
    setIsLoading(true);
    form
      .validateFields()
      .then(() => {
        setTimeout(() => {
          notificationController.success({ message: t('common.success') });
          setIsLoading(false);
          setOpen(!open);
        }, 3000);
      })
      .catch(() => {
        notificationController.error({ message: t('common.error') });
        setIsLoading(false);
      });
  };

  return (
    <Spinner spinning={isLoading} size={'large'}>
      <BaseForm
        name={`${name}Form`}
        form={form}
        fields={fields}
        onFieldsChange={(_, allFields) => {
          const currentFields = allFields.map((item) => ({
            name: Array.isArray(item.name) ? item.name[0] : '',
            value: item.value,
          }));
          const uniqueData = mergeBy(fields, currentFields, 'name');
          setFields(uniqueData);
        }}
      >
        <S.FormContent>
          <Row justify={'space-around'} align={'middle'}>
            <Col>
              <BaseForm.Item
                name="name"
                label={fieldUi.name}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Account Name`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.name} />
              </BaseForm.Item>

              <BaseForm.Item
                name="glCode"
                label={fieldUi.glCode}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Account Name`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.glCode} />
              </BaseForm.Item>
              <BaseForm.Item
                name="type"
                label={fieldUi.type}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Account Name`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Select
                  options={accountType}
                  allowClear
                  width={'100%'}
                  placeholder={'Select Account Type'}
                />
              </BaseForm.Item>
              <BaseForm.Item
                name="note"
                label={fieldUi.note}
                rules={[
                  {
                    required: false,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Note`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.note} />
              </BaseForm.Item>
            </Col>
          </Row>

        </S.FormContent>
        <S.ActionWrapper>
          <Button
            type="primary"
            onClick={(e) => handleSubmit(e)}
            loading={isLoading}
            style={{
              width: 150,
            }}
          >
            {!isLoading ? 'Submit' : 'Processing...'}
          </Button>
          {!isLoading ? (
            <Button
              onClick={() => setOpen(!open)}
              style={{
                right: 31,
                position: 'absolute',
                width: 150,
              }}
              danger
            >
              Cancel
            </Button>
          ) : null}
        </S.ActionWrapper>
      </BaseForm>
    </Spinner>
  );
};
