import { useState } from 'react';
import { BaseForm } from '@app/components/common/forms/BaseForm/BaseForm';
import * as S from './LoanLayoutForm.styles';
import { Button } from '@app/components/common/buttons/Button/Button';
import { mergeBy } from '@app/utils/utils';
import { Col, Row } from 'antd';
import { Input, TextArea } from '@app/components/common/inputs/Input/Input';
import { useTranslation } from 'react-i18next';
import { notificationController } from '@app/controllers/notificationController';
import { Spinner } from '@app/components/common/Spinner/Spinner';
import { Content } from 'antd/lib/layout/layout';

interface IBranchesForm {
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

export const LoanLayoutForm: React.FC<IBranchesForm> = (
  collectionForm: IBranchesForm,
) => {
  const { t } = useTranslation();

  const { open, setOpen } = collectionForm;
  const [isLoading, setIsLoading] = useState(false);
  const [form] = BaseForm.useForm();
  const [fields, setFields] = useState<FieldData[]>([
    { name: 'name', value: '' },
  ]);

  const fieldUi: FormValues = {
    name: t('forms.fields.field', { name: `Form Name` }),
  };

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
          <Row>
            <Col>
              <BaseForm.Item
                name="name"
                label={fieldUi.name}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Form name`,
                    }),
                  },
                ]}
              >
                <Input placeholder={fieldUi.name} />
              </BaseForm.Item>
            </Col>
            <Col style={{
              width: '80%',
              paddingLeft: 24
            }}>
              <Content
                style={{
                  padding: 24,
                  margin: 0,
                  minHeight: 600,
                  background: '#cccccc',
                  borderRadius: 10,
                  overflow: 'scroll'
                }}
              >
                Content
              </Content>
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
